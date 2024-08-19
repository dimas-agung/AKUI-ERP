<?php

namespace App\Services;

use Exception;
use App\Models\GradingWarna;
use Illuminate\Http\Request;
use App\Models\GradingWarnaStock;
use App\Models\GradingWarnaAdding;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\GradingWarnaAddingStock;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GradingWarnaService
{
    protected $HppService;

    public function __construct(HppService $HppService)
    {
        $this->HppService = $HppService;
    }
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        $dataColl = collect($dataArray);
        $berat_gradings = array();
        $harga_estimasi = array();
        $totalModal = array();

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau kontribusi kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        foreach ($dataColl as $key => $value) {
            $berat_gradings[] = $value['berat_grading']; // Mengubah akses menjadi array asosiatif
            $harga_estimasi[] = $value['harga_estimasi']; // Mengubah akses menjadi array asosiatif
            $totalModal[] = $value['total_modal']; // Mengubah akses menjadi array asosiatif
            $jenisGradings[] = $value['jenis_grading']; // Mengubah akses menjadi array asosiatif
        };
        // Calculate HPP values using HppService
        $dataHpp = $this->HppService->calculate($berat_gradings, $harga_estimasi, $totalModal, $jenisGradings);
        // return $berat_gradings;
        // Loop through each item in dataArray
        foreach ($dataArray as $key => $data) {

            // Update data with HPP values
            $data['total_harga'] = $dataHpp[$key]['total_harga'];
            $data['nilai_laba_rugi'] = $dataHpp[$key]['nilai_laba_rugi'];
            $data['nilai_prosentase_total_keuntungan'] = $dataHpp[$key]['nilai_prosentase_total_keuntungan'];
            $data['nilai_dikurangi_keuntungan'] = $dataHpp[$key]['nilai_setelah_dikurangi_keuntungan'];
            $data['prosentase_harga_gramasi'] = $dataHpp[$key]['prosentase_harga_gramasi'];
            $data['selisih_laba_rugi_kg'] = $dataHpp[$key]['selisih_laba_rugi_kg'];
            $data['selisih_laba_rugi_per_gram'] = $dataHpp[$key]['selisih_laba_rugi_gram'];
            $data['hpp'] = $dataHpp[$key]['hpp'];
            $data['total_hpp'] = $dataHpp[$key]['total_hpp'];
            $data['fix_hpp'] = $dataHpp[$key]['fix_hpp'];
            $data['fix_total_hpp'] = $dataHpp[$key]['fix_total_hpp'];

            // Validate each item in dataArray
            $validator = Validator::make($data, [
                'nomor_lot' => 'required', // Change with appropriate field name
                'berat_grading' => 'required', // Change with appropriate field name
                'kontribusi' => 'required', // Change with appropriate field name
                // ... add other validations as needed
            ]);

            // If validation fails, return error message
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                ], 400);
            } else {
                try {
                    DB::beginTransaction();

                    // Create Grading Warna
                    GradingWarna::create($data);

                    $GradingWarna = (object) $data;

                    // Ambil semua item yang sesuai dengan kriteria
                    $GradingWarnaStock = GradingWarnaStock::where('id_box_grading_warna', '=', $GradingWarna->id_box_grading_warna)
                        ->get();

                    $found = false;

                    foreach ($GradingWarnaStock as $item) {
                        $found = true;

                        // Hitung sisa berat dan sisa pcs
                        $beratMasuk = $item->berat_masuk + ($GradingWarna->berat_grading ?? 0);
                        $pcsMasuk = $item->pcs_masuk + ($GradingWarna->pcs_grading ?? 0);
                        $sisaBerat = $beratMasuk - $item->berat_keluar;
                        $sisaPcs = $pcsMasuk;
                        // $totalModal = $item->modal * $sisaBerat;
                        $totalModalbaru = $item->total_modal + $GradingWarna->fix_total_hpp;
                        $modal = $totalModalbaru/$sisaBerat;

                        // Update data dengan nilai baru
                        $item->update([
                            'berat_masuk'  => $beratMasuk,
                            'pcs_masuk'    => $pcsMasuk,
                            'sisa_berat'   => $sisaBerat,
                            'sisa_pcs'     => $sisaPcs,
                            'modal' => $modal,
                            'total_modal'  => $totalModalbaru,
                            'user_updated' => $GradingWarna->user_created ?? "There isn't any",
                        ]);
                    }

                    if (!$found) {

                        GradingWarnaStock::create([
                            'unit'                      => $data['unit'] ?? 'Grading Warna',
                            'id_box_grading_warna'      => $data['id_box_grading_warna'],
                            'nomor_batch'               => $data['nomor_batch'],
                            'tujuan_kirim'              => $data['tujuan_kirim'],
                            'jenis_grading'             => $data['jenis_grading'],
                            'berat_masuk'               => $data['berat_grading'] ?? 0,
                            'berat_keluar'              => $data['berat_keluar'] ?? 0,
                            'sisa_berat'                => $data['berat_grading'] ?? 0,
                            'pcs_masuk'                 => $data['pcs_grading'],
                            'pcs_keluar'                => $data['pcs_keluar'] ?? 0,
                            'sisa_pcs'                  => $data['pcs_grading'] ?? 0,
                            'modal'                     => $data['fix_hpp'] ?? 0,
                            'total_modal'               => $data['fix_hpp'] * $data['berat_grading'] ?? 0,
                        ]);
                    }

                    // Update Stock Grading Warna Adding Stock
                    $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarna->nomor_lot)
                        ->get();

                    foreach ($GradingWarnaAddingStock as $item) {

                        $beratSebelumnya = $item->berat_keluar;
                        $pcsSebelumnya = $item->pcs_keluar;

                        // Hitung sisa berat dan sisa pcs
                        $beratKeluar = $beratSebelumnya + $GradingWarna->berat_grading;
                        $pcsKeluar = $pcsSebelumnya + $GradingWarna->pcs_grading;
                        $sisaBerat = $item->berat_masuk - $beratKeluar;
                        $sisaPcs = $item->pcs_masuk - $pcsKeluar;
                        $totalModal = $item->modal * $sisaBerat;

                        // Update data dengan nilai baru
                        $item->update([
                            'berat_keluar'  => $beratKeluar,
                            'pcs_keluar'    => $pcsKeluar,
                            'sisa_berat'    => $sisaBerat,
                            'sisa_pcs'      => $sisaPcs,
                            'total_modal'   => $totalModal,
                            'status' => 0,
                            'user_updated'  => $GradingWarna->user_created ?? "There isn't any",
                        ]);
                    }

                    // Update Status Adding Stock
                    $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarna->nomor_lot)
                        ->where('sisa_berat', 0)
                        ->get();
                    foreach ($GradingWarnaAddingStock as $item) {
                        $item->update([
                            'status'       => GradingWarna::STATUS_NON_AKTIF,
                        ]);
                    }

                    // Update Status Adding
                    $GradingWarnaAdding = GradingWarnaAdding::where('nomor_lot', '=', $GradingWarna->nomor_lot)
                        ->get();
                    foreach ($GradingWarnaAdding as $item) {
                        $item->update([
                            'status'       => GradingWarna::STATUS_NON_AKTIF,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingWarna.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('GradingWarna.index')
        ], 201);
    }

    public function destroy($nomor_lot)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

          
            //get data all  by bstb
            $GradingWarnas = GradingWarna::where('nomor_lot',$nomor_lot)->get();
            
            if (!$GradingWarnas) {
                 // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingWarna.index')->with(['error' => 'Data tidak ditemukan!']);
            }
            foreach ($GradingWarnas as $key => $GradingWarna) {
                # code...
                // Grading Warna Stock
                $GradingWarnaStock = GradingWarnaStock::where('id_box_grading_warna', '=', $GradingWarna->id_box_grading_warna)
                    ->first();
                
                if ($GradingWarnaStock) {
    
                    // Simpan nilai sebelum dihapus
                    $beratSebelumnya = $GradingWarnaStock->berat_masuk;
                    $pcsSebelumnya = $GradingWarnaStock->pcs_masuk;
    
                    // Hitung perbedaan berat dan pcs
                    $beratBaru = $beratSebelumnya - $GradingWarna->berat_grading;
                    $pcsBaru = $pcsSebelumnya - $GradingWarna->pcs_grading;
                    $sisaBeratBaru = $beratBaru - $GradingWarnaStock->berat_keluar;
                    $sisaPcsBaru = $pcsBaru- $GradingWarnaStock->pcs_keluar;
                    $totalModalBaru = $GradingWarnaStock->total_modal - $GradingWarna->fix_total_hpp;
                    $modalBaru = $sisaBeratBaru == 0 ? 0 : $totalModalBaru / $sisaBeratBaru;
                    // $response = 'TOTAL MODAL STOCK = '. $GradingWarnaStock->total_modal.', total_modal_hapus ='. $GradingWarna->fix_total_hpp.', id_box_hapus= '.$GradingWarna->id_box_grading_warna;
                    // return $response;
                    if ($sisaBeratBaru <= 0 && $sisaPcsBaru <= 0) {
                        // Hapus data GradingWarnaStock jika sisa_berat dan sisa_pcs baru <= 0
                        $GradingWarnaStock->delete();
                    } else {
                        // Update data GradingWarnaStock dengan berat, pcs, dan sisa yang baru
                        $GradingWarnaStock->update([
                            'berat_masuk'   => $beratBaru,
                            'pcs_masuk'     => $pcsBaru,
                            'sisa_berat'    => $sisaBeratBaru,
                            'sisa_pcs'      => $sisaPcsBaru,
                            'modal' => $modalBaru,
                            'total_modal'   => $totalModalBaru,
                        ]);
                    }
                }
    
                // Grading Warna Adding Stock
                $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarna->nomor_lot)
                    ->first();
    
                if ($GradingWarnaAddingStock) {
    
                    // Simpan nilai sebelum dihapus
                    $beratSebelumnya = $GradingWarnaAddingStock->berat_keluar;
                    $pcsSebelumnya = $GradingWarnaAddingStock->pcs_keluar;
    
                    // Hitung perbedaan berat dan pcs
                    $beratBaru = $beratSebelumnya - $GradingWarna->berat_grading;
                    $pcsBaru = $pcsSebelumnya - $GradingWarna->pcs_grading;
                    $sisaBeratBaru = $GradingWarnaAddingStock->berat_masuk - $beratBaru;
                    $sisaPcsBaru = $GradingWarnaAddingStock->pcs_masuk -$pcsBaru ;
                    $totalModal = $GradingWarnaAddingStock->modal * $sisaBeratBaru;
    
                    // Update data GradingWarnaAddingStock dengan berat, pcs, dan sisa yang baru
                    $GradingWarnaAddingStock->update([
                        'berat_keluar'  => $beratBaru,
                        'pcs_keluar'    => $pcsBaru,
                        'sisa_berat'    => $sisaBeratBaru,
                        'sisa_pcs'      => $sisaPcsBaru,
                        'total_modal'   => $totalModal,
                        'status' => 1,
                    ]);
                    // }
                }
    
                $GradingWarna->delete();
    
    
                // Ambil nomor_lot dari GradingWarna yang ingin diperiksa
                $nomor_lot = $GradingWarna->nomor_lot;
    
                // Periksa apakah nomor_lot sudah tidak ada di tabel GradingWarna
                $exists = GradingWarna::where('nomor_lot', '=', $nomor_lot)->exists();
    
                // Update Status Grading Adding Stock
                if (!$exists) {
                    $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarna->nomor_lot)
                        ->get();
                    foreach ($GradingWarnaAddingStock as $item) {
                        $item->update([
                            'status'       => GradingWarna::STATUS_AKTIF,
                        ]);
                    }
                }
    
                // Update Status Grading Warna Adding
                if (!$exists) {
                    // Jika nomor_lot tidak ada, update status di GradingWarnaAdding
                    $GradingWarnaAdding = GradingWarnaAdding::where('nomor_lot', '=', $nomor_lot)->get();
                    foreach ($GradingWarnaAdding as $item) {
                        $item->update([
                            'status' => GradingWarna::STATUS_AKTIF,
                        ]);
                    }
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('GradingWarna.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('GradingWarna.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
