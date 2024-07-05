<?php

namespace App\Services;

use Exception;
use App\Models\GradingWarna;
use Illuminate\Http\Request;
use App\Models\GradingWarnaStock;
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
                        $sisaBerat = $beratMasuk;
                        $sisaPcs = $pcsMasuk;
                        $totalModal = $item->modal * $sisaBerat;

                        // Update data dengan nilai baru
                        $item->update([
                            'berat_masuk'  => $beratMasuk,
                            'pcs_masuk'    => $pcsMasuk,
                            'sisa_berat'   => $sisaBerat,
                            'sisa_pcs'     => $sisaPcs,
                            'total_modal'  => $totalModal,
                            'user_updated' => $GradingWarna->user_created ?? "There isn't any",
                        ]);
                    }

                    if (!$found) {

                        GradingWarnaStock::create([
                            'unit'                      => $data['unit'] ?? 'Grading Warna',
                            'id_box_grading_warna'      => $data['id_box_grading_warna'],
                            'nomor_batch'               => $data['nomor_batch'],
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

                    // Update Status Adding Stock
                    $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarna->nomor_lot)
                        ->where('sisa_berat', 0)
                        ->get();
                    foreach ($GradingWarnaAddingStock as $item) {
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

    // public function destroy($id): RedirectResponse
    // {
    //     try {
    //         // Start transaction
    //         DB::beginTransaction();

    //         // Find the record by id
    //         $GradingHalusAdjustmentInput = GradingHalusAdjustmentInput::findOrFail($id);

    //         $nomorAdjustment = $GradingHalusAdjustmentInput->nomor_adjustment;

    //         // Find all items with the same nomor_adjustment
    //         $findNomorAdjustment = GradingHalusAdjustmentInput::where('nomor_adjustment', $nomorAdjustment)->get();

    //         // Check if any GradingHalusInputs have status 0 with the same created_at time
    //         foreach ($findNomorAdjustment as $GradingInput) {
    //             $createdAt = $GradingInput->created_at;

    //             // Find other data with the same created_at time and status 0
    //             $sameTimeStatusZero = GradingHalusAdjustmentInput::where('created_at', '=', $createdAt)
    //                 ->where('status', '=', 0)
    //                 ->exists();

    //             if ($sameTimeStatusZero) {
    //                 // Rollback transaction if there is data with status 0 and the same created_at time
    //                 DB::rollBack();
    //                 // Save warning message in session
    //                 session()->flash('warning', 'Data tidak bisa dihapus karena ada data lain dengan status 0 yang dibuat pada waktu yang sama.');
    //                 // Redirect back to the previous page
    //                 return back();
    //             }
    //         }

    //         foreach ($findNomorAdjustment as $item) {
    //             // Find related stock
    //             $gradingHalusStock = GradingHalusStock::where('id_box_grading_halus', $item->id_box_grading_halus)
    //                 ->first();

    //             if ($gradingHalusStock) {
    //                 $beratSebelumnya = $gradingHalusStock->berat_masuk;
    //                 $pcsSebelumnya = $gradingHalusStock->pcs_masuk;

    //                 $perbedaanBerat = $beratSebelumnya - $item->berat_adjustment;
    //                 $perbedaanPcs = $pcsSebelumnya - $item->pcs_adjustment;
    //                 $sisaBerat = $perbedaanBerat - $gradingHalusStock->berat_keluar;
    //                 $sisaPcs = $perbedaanPcs - $gradingHalusStock->pcs_keluar;

    //                 if ($sisaBerat <= 0) {
    //                     $gradingHalusStock->delete();
    //                 } else {
    //                     $totalModalBaru = $sisaBerat * $gradingHalusStock->modal;

    //                     $gradingHalusStock->update([
    //                         'berat_masuk' => $perbedaanBerat,
    //                         'sisa_berat' => $sisaBerat,
    //                         'pcs_masuk' => $perbedaanPcs,
    //                         'sisa_pcs' => $sisaPcs,
    //                         'total_modal' => $totalModalBaru,
    //                         'status' => 1,
    //                     ]);
    //                 }
    //             }

    //             // Delete related item
    //             $item->delete();
    //         }

    //         $existingItems = GradingHalusAdjustmentStock::where('nomor_adjustment', $GradingHalusAdjustmentInput->nomor_adjustment)
    //             ->where('nomor_batch', $GradingHalusAdjustmentInput->nomor_batch)
    //             ->get();

    //         // Update Status Logic
    //         foreach ($existingItems as $existingItem) {
    //             if ($existingItem) {
    //                 $existingItem->update(['status' => 1]);
    //             }
    //         }

    //         $GradingHalusAdjustmentAdding = GradingHalusAdjustmentAdding::where('nomor_adjustment', $GradingHalusAdjustmentInput->nomor_adjustment)
    //             ->where('nomor_batch', $GradingHalusAdjustmentInput->nomor_batch)
    //             ->get();

    //         // Update Status Logic
    //         foreach ($GradingHalusAdjustmentAdding as $item) {
    //             if ($item) {
    //                 $item->update(['status' => 1]);
    //             }
    //         }

    //         // Commit transaction if no errors
    //         DB::commit();

    //         return redirect()->route('GradingHalusAdjustmentInput.index')->with('success', 'Data berhasil dihapus');
    //     } catch (Exception $e) {
    //         // Rollback transaction if any errors
    //         DB::rollback();

    //         return redirect()->route('GradingHalusAdjustmentInput.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    //     }
    // }
}
