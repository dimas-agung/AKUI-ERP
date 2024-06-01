<?php

namespace App\Services;

use App\Models\DryAGradingCabut;
use App\Models\DryAGradingCabutStock;
use App\Models\DryAPenerimaanCabutStock;
use App\Models\MasterJenisGradingHalus;
use App\Models\PreCleaningOutput;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class DryAGradingCabutService
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
        $tableDataArray = json_decode($request->input('tableDataArray'), true);

        $dataColl = collect($dataArray);
        $berat_gradings = array();
        $harga_estimasi = array();
        $totalModal = array();

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray) || empty($tableDataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau data susut atau kontribusi kosong. Tidak ada data untuk disimpan.',
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

        // Loop through each item in dataArray
        foreach ($dataArray as $key => $data) {
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data, $tableDataArray[$key]);

            // Update data with HPP values
            $mergedData['total_harga'] = $dataHpp[$key]['total_harga'];
            $mergedData['nilai_laba_rugi'] = $dataHpp[$key]['nilai_laba_rugi'];
            $mergedData['nilai_prosentase_total_keuntungan'] = $dataHpp[$key]['nilai_prosentase_total_keuntungan'];
            $mergedData['nilai_dikurangi_keuntungan'] = $dataHpp[$key]['nilai_setelah_dikurangi_keuntungan'];
            $mergedData['prosentase_harga_gramasi'] = $dataHpp[$key]['prosentase_harga_gramasi'];
            $mergedData['selisih_laba_rugi_kg'] = $dataHpp[$key]['selisih_laba_rugi_kg'];
            $mergedData['selisih_laba_rugi_per_gram'] = $dataHpp[$key]['selisih_laba_rugi_gram'];
            $mergedData['hpp'] = $dataHpp[$key]['hpp'];
            $mergedData['total_hpp'] = $dataHpp[$key]['total_hpp'];
            $mergedData['fix_hpp'] = $dataHpp[$key]['fix_hpp'];
            $mergedData['fix_total_hpp'] = $dataHpp[$key]['fix_total_hpp'];

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                // 'nomor_grading' => 'required', // Change with appropriate field name
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

                    // Create instance of GradingHalusInput
                    // GradingHalusInput::create($mergedData);
                    DryAGradingCabut::create($mergedData);

                    // $grading = GradingHalusStock::where('id_box_grading_halus', $mergedData['id_box_grading_halus'])
                    //     ->first();
                    $grading = DryAGradingCabutStock::where('nomor_job', $mergedData['nomor_job'])
                        ->first();

                    if ($grading) {
                        // $total_berat = $grading->berat_masuk + ($mergedData['berat_grading'] ?? 0);
                        $hpp = $this->HppService->recalculateHpp($grading->berat_grading, $grading->modal, $mergedData['fix_total_hpp'], $mergedData['berat_grading']);

                        // Update existing grading data
                        $grading->update([
                            'berat_1_grading'       => $grading->berat_grading + ($mergedData['berat_grading'] ?? 0),
                            'pcs_1_grading'         => $grading->pcs_1_grading + ($mergedData['pcs_grading'] ?? 0),
                            'berat_keluar'          => $grading->berat_keluar + ($mergedData['berat_keluars'] ?? 0),
                            'pcs_keluar'            => $grading->pcs_keluar + ($mergedData['pcs_keluars'] ?? 0),
                            'sisa_berat'            => $grading->sisa_berat + ($mergedData['berat_grading'] ?? 0),
                            'sisa_pcs'              => $grading->sisa_pcs + ($mergedData['pcs_grading'] ?? 0),
                            'modal'                 => $hpp,
                            'total_modal'           => $hpp * ($grading->sisa_berat + $mergedData['berat_grading']),
                            'user_update'           => $mergedData['user_updated'] ?? "There isn't any",
                        ]);
                    } else {
                        // Create new grading data
                        // GradingHalusStock::create([
                        DryAGradingCabutStock::create([
                            'unit'                  => $mergedData['unit'] ?? 'Dry A',
                            'nomor_job'             => $mergedData['nomor_job'],
                            'nomor_batch'           => $mergedData['nomor_batch'],
                            'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                            'keterangan'            => $mergedData['keterangan'],
                            'berat_kotor'           => $mergedData['berat_kotor'],
                            'jenis_grading'         => $mergedData['jenis_grading'],
                            'berat_1_grading'       => $mergedData['berat_1_grading'],
                            'pcs_1_grading'         => $mergedData['pcs_1_grading'],
                            'berat_2_grading'       => $mergedData['berat_2_grading'],
                            'modal'                 => $mergedData['fix_hpp'],
                            'total_modal'           => $mergedData['fix_total_hpp'],

                        ]);
                    }

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    // $existingItems = PreGradingHalusAddingStock::where('nomor_grading', $itemObject->nomor_grading)
                    //     ->where('nomor_batch', $itemObject->nomor_batch)
                    //     ->get();
                    $existingItems = DryAPenerimaanCabutStock::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'status'         => $itemObject->status ?? 0,
                        ]);
                    }

                    // $existingItems = MasterJenisGradingHalus::where('jenis', $itemObject->jenis_grading)
                    //     ->get();

                    // $dataToUpdate = [
                    //     'status'                => $itemObject->status ?? 0,
                    // ];

                    // if ($existingItems) {
                    //     foreach ($existingItems as $existingItem) {
                    //         $existingItem->update($dataToUpdate);
                    //     }
                    // }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('DryAGradingCabut.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAGradingCabut.index')
        ], 201);
    }

    public function destroy($nomor_job): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_job
            // $GradingHalusInputs = GradingHalusInput::where('nomor_job', '=', $nomor_job)->get();
            $DryAGradingCabut = DryAGradingCabut::where('nomor_job', '=', $nomor_job)->get();

            // if ($DryAGradingCabut->isEmpty()) {
            //     // Redirect ke index dengan pesan error jika data tidak ditemukan
            //     return redirect()->route('DryAGradingCabut.index')->with(['error' => 'Data tidak ditemukan!']);
            // }

            // Cek apakah salah satu dari GradingHalusInputs memiliki status 0 dengan waktu created_at yang sama
            // foreach ($GradingHalusInputs as $GradingInput) {
            //     $createdAt = $GradingInput->created_at;
            //     $now = now();

            //     // Cari data lain dengan waktu created_at yang sama dan status 0
            //     $sameTimeStatusZero = GradingHalusInput::where('created_at', '=', $createdAt)
            //         ->where('status', '=', 0)
            //         ->exists();

            //     if ($sameTimeStatusZero && $createdAt->diffInMinutes($now) > 10) {
            //         // Rollback transaksi jika ada data dengan status 0 dan waktu created_at lebih dari 10 menit
            //         DB::rollBack();
            //         // Simpan pesan peringatan dalam session
            //         session()->flash('warning', 'Data tidak bisa dihapus karena sudah lebih dari 10 menit sejak dibuat dan ada data lain dengan status 0.');
            //         // Kembali ke halaman sebelumnya
            //         return back();
            //     }
            // }

            foreach ($DryAGradingCabut as $DryGradingCabut) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                // $PreCleaningS = GradingHalusStock::where('id_box_grading_halus', '=', $DryGradingCabut->id_box_grading_halus)
                //     ->first();
                $DryAGradingCabutStock = DryAGradingCabutStock::where('nomor_job', '=', $DryGradingCabut->nomor_job)
                    ->first();


                $DryAGradingCabutStock->delete();

                if ($DryAGradingCabutStock) {
                    // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                    // $stockPrmRawMaterial = PreGradingHalusAddingStock::where('nomor_grading', '=', $DryGradingCabut->nomor_grading)
                    //     ->first();
                    $stockPrmRawMaterial = DryAPenerimaanCabutStock::where('nomor_job', '=', $DryGradingCabut->nomor_job)
                        ->first();

                    if ($stockPrmRawMaterial) {
                        // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                        $stockPrmRawMaterial->update([
                            // 'berat_adding' => max($DryGradingCabut->berat_adding, 0),
                            // 'pcs_adding' => max($DryGradingCabut->pcs_adding, 0),
                            // 'total_modal' => max($DryGradingCabut->total_modal, 0),
                            'status' => 1,
                        ]);
                    }
                }

                // if ($PreCleaningI->berat_grading >= $PreCleaningS->berat_masuk) {
                //     $PreCleaningS->delete();
                // } else {
                //     $hpp = $this->HppService->recalculateHppAfterDelete($PreCleaningS->berat_masuk, $PreCleaningS->modal, $PreCleaningI['fix_total_hpp'], $PreCleaningI['berat_grading']);
                //     // Simpan nilai sebelum dihapus
                //     $beratSebelumnya = $PreCleaningS->berat_masuk;
                //     $pcsSebelumnya = $PreCleaningS->pcs_masuk;

                //     // Hitung total modal baru
                //     $totalBeratBaru = $beratSebelumnya - $PreCleaningI->berat_grading;
                //     $totalPcsBaru = $pcsSebelumnya - $PreCleaningI->pcs_grading;

                //     // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                //     $PreCleaningS->update([
                //         'berat_masuk' => $totalBeratBaru,
                //         'sisa_berat' => $totalBeratBaru,
                //         'pcs_masuk' => $totalPcsBaru,
                //         'sisa_pcs' => $totalPcsBaru,
                //         'modal' => $hpp,
                //         'total_modal' => $hpp * ($PreCleaningS->sisa_berat + $PreCleaningI['berat_grading']),
                //     ]);
                // }

                // Hapus data GradingHalusInput
                $DryGradingCabut->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAGradingCabut.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAGradingCabut.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
