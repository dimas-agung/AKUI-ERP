<?php
namespace App\Services;

use App\Models\GradingHalusOutput;
use App\Models\PreWashOutput;
use App\Models\PreWashStock;
use App\Models\TransitGradingHalus;
use Illuminate\Http\Request;
use App\Models\PreWashInput;
use App\Models\GradingHalusStock;
use App\Models\TransitPreCleaningStock;
use App\Models\TransitPreWash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class PreWashOutputService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('data'), true);

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        // Loop through each item in dataArray
        foreach ($dataArray as $data) {
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data);

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                'berat_job' => 'required', // Change with appropriate field name
                'pcs_job' => 'required', // Change with appropriate field name
                'tujuan_kirim' => 'required', // Change with appropriate field name
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
                    PreWashOutput::create($mergedData);

                    TransitPreWash::create([
                        'unit'                  => $mergedData['unit'] ?? 'Pre Wash',
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'jenis_job'             => $mergedData['jenis_job'],
                        'berat_job'           => $mergedData['berat_job'] ?? 0,
                        'pcs_job'             => $mergedData['pcs_job'] ?? 0,
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'],
                        'modal'                 => $mergedData['modal'],
                        'total_modal'           => $mergedData['total_modal'],
                        'user_created'          => $mergedData['user_created'],
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = PreWashStock::where('nomor_job', $itemObject->nomor_job)
                    ->get();

                    foreach ($existingItems as $existingItem) {
                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'berat_job' => $itemObject->berat_jobs ?? 0,
                            'pcs_job'   => $itemObject->pcs_jobs ?? 0,
                            'total_modal'  => $itemObject->total_modal,
                            'user_updated' => $itemObject->user_created ?? "There isn't any",
                        ]);
                    }

                    // $existingItems = PreWashInput::where('nomor_job', $itemObject->nomor_job)
                    // ->get();

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
                        'redirectTo' => route('PreWashOutput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('PreWashOutput.index')
        ], 201);
    }

    public function destroy($nomor_bstb): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan id_box_grading$nomor_bstb
            $GradingHalusInputs = PreWashOutput::where('nomor_bstb', '=', $nomor_bstb)->get();

            if ($GradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('PreWashOutput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($GradingHalusInputs as $PreCleaningI) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = TransitPreWash::where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
                    ->first();

                    if ($PreCleaningS) {
                        // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                        $stockPrmRawMaterial = PreWashStock::where('nomor_job', '=', $PreCleaningI->nomor_job)
                            ->first();

                        if ($stockPrmRawMaterial) {
                            // Simpan nilai sebelum dihapus
                            $beratSebelumnya = $stockPrmRawMaterial->berat_job;
                            $pcsSebelumnya = $stockPrmRawMaterial->pcs_job;

                            // Hitung perbedaan berat dan pcs
                            $perbedaanBerat = $PreCleaningI->berat_job;
                            $perbedaanPcs = $PreCleaningI->pcs_job;

                            // Hitung total modal baru
                            $totalModalBaru = $perbedaanBerat * $PreCleaningI->modal;

                            // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                            $stockPrmRawMaterial->update([
                                'berat_job' => max($PreCleaningI->berat_job, 0),
                                'pcs_job' => max($PreCleaningI->pcs_job, 0),
                                'total_modal' => max($perbedaanBerat * $PreCleaningI->modal, 0),
                            ]);
                        }
                    }

                if ($PreCleaningS) {
                    // Hapus data PreCleaningStock
                    $PreCleaningS->delete();
                }

                // Hapus data GradingHalusInput
                $PreCleaningI->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('PreWashOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('PreWashOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
