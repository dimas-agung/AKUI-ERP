<?php

namespace App\Services;

use App\Models\GradingHalusOutput;
use App\Models\MasterJenisGradingHalus;
use App\Models\PreCleaningOutput;
use App\Models\TransitGradingHalus;
use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class GradingHalusOutputService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

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
                'id_box_grading_halus' => 'required', // Change with appropriate field name
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
                    GradingHalusOutput::create($mergedData);

                    TransitGradingHalus::create([
                        'unit'                  => $mergedData['unit'] ?? 'grading halus',
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'jenis_job'             => $mergedData['jenis_job'],
                        'upah_operator'         => $mergedData['upah_operator'],
                        'berat_job'           => $mergedData['berat_job'] ?? 0,
                        'pcs_job'             => $mergedData['pcs_job'] ?? 0,
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'],
                        'modal'                 => $mergedData['modal'],
                        'total_modal'           => $mergedData['total_modal'],
                        'user_created'          => $mergedData['user_created'],
                        'user_update'           => $mergedData['user_updated'] ?? "There isn't any",
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = GradingHalusStock::where('id_box_grading_halus', $itemObject->id_box_grading_halus)
                        ->get();

                    foreach ($existingItems as $existingItem) {
                        // Hitung sisa berat dan sisa pcs
                        // $sisaBerat = $existingItem->berat_masuk - ($itemObject->berat_job ?? 0);
                        // $sisaPcs = $existingItem->pcs_masuk - ($itemObject->pcs_job ?? 0);
                        // $totalModal = $sisaBerat * ($existingItem->modal ?? 0);
                        $sisaBerat = $existingItem->berat_masuk - ( $existingItem->berat_keluar  + ($itemObject->berat_job ?? 0));
                        $sisaPcs = $existingItem->pcs_masuk - ( $existingItem->pcs_keluar  + ($itemObject->pcs_job ?? 0));
                        $totalModal = $sisaBerat * ($existingItem->modal ?? 0);

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'berat_keluar' =>  $existingItem->berat_keluar  + ($itemObject->berat_job ?? 0),
                            'pcs_keluar'   =>  $existingItem->pcs_keluar  + ($itemObject->pcs_job ?? 0),
                            'sisa_berat'   => $sisaBerat,
                            'sisa_pcs'     => $sisaPcs,
                            'total_modal'  => $totalModal,
                            'user_updated' => $itemObject->user_created ?? "There isn't any",
                        ]);
                    }

                    $existingItems = GradingHalusInput::where('id_box_grading_halus', $itemObject->id_box_grading_halus)
                        ->get();

                    $dataToUpdate = [
                        'status'                => $itemObject->status ?? 0,
                    ];

                    if ($existingItems) {
                        foreach ($existingItems as $existingItem) {
                            $existingItem->update($dataToUpdate);
                        }
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingHalusInput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('GradingHalusOutput.index')
        ], 201);
    }

    public function destroy($id_box_grading_halus): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data gradinhHalusInputnput berdasarkan id_box_grading$id_box_grading_halus
            $GradingHalusInputs = GradingHalusOutput::where('id_box_grading_halus', '=', $id_box_grading_halus)->get();

            if ($GradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingHalusOutput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($GradingHalusInputs as $gradinhHalusInput) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = TransitGradingHalus::where('nomor_job', '=', $gradinhHalusInput->nomor_job)
                    ->first();

                if ($PreCleaningS) {
                    // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                    $StockGradingHalus = GradingHalusStock::where('id_box_grading_halus', '=', $gradinhHalusInput->id_box_grading_halus)
                        ->first();

                    if ($StockGradingHalus) {
                        // Simpan nilai sebelum dihapus
                        $beratSebelumnya = $StockGradingHalus->berat_masuk;
                        $pcsSebelumnya = $StockGradingHalus->pcs_masuk;

                        // Hitung perbedaan berat dan pcs
                        $perbedaanBerat = $gradinhHalusInput->berat_adding;
                        $perbedaanPcs = $gradinhHalusInput->pcs_adding;
                        $sisaBerat = $StockGradingHalus->berat_masuk - ( $StockGradingHalus->berat_keluar  - ($gradinhHalusInput->berat_job ?? 0));
                        $sisaPcs = $StockGradingHalus->pcs_masuk - ( $StockGradingHalus->pcs_keluar  - ($gradinhHalusInput->pcs_job ?? 0));
                        $totalModal = $sisaBerat * ($StockGradingHalus->modal ?? 0);
                        // Hitung total modal baru
                        $totalModalBaru = $beratSebelumnya * $gradinhHalusInput->modal;

                        // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                        $StockGradingHalus->update([
                            'berat_keluar' => max(0, ( $StockGradingHalus->berat_keluar  - ($gradinhHalusInput->berat_job ?? 0))),
                            'pcs_keluar' => max(0, ( $StockGradingHalus->pcs_keluar  - ($gradinhHalusInput->pcs_job ?? 0))),
                            'sisa_berat' => max($sisaBerat, 0),
                            'sisa_pcs' => max($sisaPcs, 0),
                            'total_modal' => max($totalModal, 0),
                        ]);
                    }
                }

                if ($PreCleaningS) {
                    // Hapus data PreCleaningStock
                    $PreCleaningS->delete();
                }

                // Hapus data GradingHalusInput
                $gradinhHalusInput->delete();

                // Perbarui status PreCleaningOutput jika ada
                $GradingHalusInput = GradingHalusInput::where('id_box_grading_halus', '=', $id_box_grading_halus)->get();

                foreach ($GradingHalusInput as $gradingHI) {
                    // Update status menjadi 1 pada CabutBuluStock
                    $gradingHI->update(['status' => 1]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('GradingHalusOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('GradingHalusOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
