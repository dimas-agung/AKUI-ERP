<?php
namespace App\Services;

use App\Models\DryAWasteInput;
use App\Models\DryAWasteOutput;
use App\Models\DryAWasteStock;
use App\Models\GradingHalusOutput;
use App\Models\MasterJenisGradingHalus;
use App\Models\PreCleaningOutput;
use App\Models\TransitGradingHalus;
use Illuminate\Http\Request;
// use App\Models\DryAWasteOutput;
use App\Models\GradingHalusStock;
use App\Models\TransitDryAWaste;
use App\Models\TransitTransitDryAWaste;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DryAWasteOutputService
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
                'berat' => 'required', // Change with appropriate field name
                'pcs' => 'required', // Change with appropriate field name
                'tujuan_kirim' => 'required', // Change with appropriate field name
                'jenis_waste' => 'required', // Change with appropriate field name
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

                    // Create instance of DryAWasteOutput
                    DryAWasteOutput::create($mergedData);

                    $berat = $mergedData['berat'];
                    $modal = $mergedData['modal'];
                    $total_modal = $berat * $modal;

                    TransitDryAWaste::create([
                        'unit'            => $mergedData['unit'] ?? 'Dry A Waste',
                        'jenis_waste'     => $mergedData['jenis_waste'],
                        'berat'           => $berat,
                        'pcs'             => $mergedData['pcs'],
                        'tujuan_kirim'    => $mergedData['tujuan_kirim'],
                        'nomor_job'       => $mergedData['nomor_job'],
                        'nomor_bstb'      => $mergedData['nomor_bstb'],
                        'keterangan'      => $mergedData['keterangan'],
                        'modal'           => $modal,
                        'total_modal'     => $total_modal,
                        'user_created'    => $mergedData['user_created'],
                        'user_update'     => $mergedData['user_updated'] ?? "There isn't any",
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = DryAWasteStock::where(['jenis_waste' => $itemObject->jenis_waste,'plant' => Auth::user()->plant])
                    ->get();

                    foreach ($existingItems as $existingItem) {
                        // Hitung sisa berat dan sisa pcs
                        $beratKeluar = $existingItem->berat_keluar + ($itemObject->berat ?? 0);
                        $pcsKeluar = $existingItem->pcs_keluar + ($itemObject->pcs ?? 0);
                        $sisaBerat = $existingItem->berat_masuk - ($beratKeluar ?? 0);
                        $sisaPcs = $existingItem->pcs_masuk - ($pcsKeluar ?? 0);

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'berat_keluar' => $beratKeluar ?? 0,
                            'pcs_keluar'   => $pcsKeluar ?? 0,
                            'sisa_berat'   => $sisaBerat,
                            'sisa_pcs'     => $sisaPcs,
                            'total_modal'  => $itemObject->total_modal,
                            'user_updated' => $itemObject->user_created ?? "There isn't any",
                        ]);
                    }

                    $existingItems = DryAWasteInput::where('jenis_waste', $itemObject->jenis_waste)
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
                        'redirectTo' => route('DryAWasteOutput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAWasteOutput.index')
        ], 201);
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data DryAWasteOutput berdasarkan id
            $DryAWasteOutput = DryAWasteOutput::findOrFail($id);

            // Ambil data TransitDryAWaste berdasarkan nomor job
            $TransitDryAWaste = TransitDryAWaste::where('nomor_job', $DryAWasteOutput->nomor_job)->first();

            if ($TransitDryAWaste) {
                // Ambil data DryAWasteStock berdasarkan jenis_waste dan create_at
                $stockPrmRawMaterial = DryAWasteStock::where(['jenis_waste' => $DryAWasteOutput->jenis_waste,'plant' => $DryAWasteOutput->plant])
                    ->first();

                if ($stockPrmRawMaterial) {
                    // Simpan nilai sebelum dihapus
                    $beratSebelumnya = $stockPrmRawMaterial->berat_masuk;
                    $pcsSebelumnya = $stockPrmRawMaterial->pcs_masuk;

                    // Hitung perbedaan berat dan pcs
                    $perbedaanBerat = $DryAWasteOutput->berat;
                    $perbedaanPcs = $DryAWasteOutput->pcs;

                    // Hitung total modal baru
                    $beratKeluar = $stockPrmRawMaterial->berat_keluar - $perbedaanBerat;
                    $pcsKeluar = $stockPrmRawMaterial->pcs_keluar - $perbedaanPcs;
                    $beratSisa = $beratSebelumnya - $beratKeluar;
                    $pcsSisa = $pcsSebelumnya - $pcsKeluar;
                    $totalModal = $stockPrmRawMaterial->modal * $beratSisa;

                    // Update data DryAWasteStock dengan berat, pcs, dan total modal yang baru
                    $stockPrmRawMaterial->update([
                        'berat_keluar' => max($beratKeluar, 0),
                        'pcs_keluar' => max($pcsKeluar, 0),
                        'sisa_berat' => max($beratSisa, 0),
                        'sisa_pcs' => max($pcsSisa, 0),
                        'total_modal' => max($totalModal, 0)
                    ]);
                }

                    $existingItems = DryAWasteInput::where('jenis_waste', '=', $DryAWasteOutput->jenis_waste)
                    ->first();

                    $dataToUpdate = [
                        'status'                => $DryAWasteOutput->status ?? 1,
                    ];

                    if ($existingItems) {
                        $dataToUpdate = [
                            'status' => $DryAWasteOutput->status ?? 1,
                        ];

                        if ($stockPrmRawMaterial->berat_keluar == 0) {
                            $existingItems->update($dataToUpdate);
                        }
                    }

                // Hapus data TransitDryAWaste
                $TransitDryAWaste->delete();
            }

            // Hapus data DryAWasteOutput
            $DryAWasteOutput->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAWasteOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAWasteOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
