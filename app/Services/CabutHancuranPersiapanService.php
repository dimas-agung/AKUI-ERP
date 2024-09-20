<?php
namespace App\Services;

use App\Models\CabutHancuranPersiapan;
use App\Models\CabutHancuranPersiapanStock;
use App\Models\GradingHalusOutput;
use App\Models\RambangBasahInput;
use App\Models\RambangBasahStock;
use App\Models\TransitGradingHalus;
use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class CabutHancuranPersiapanService
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
                'berat_keluar' => 'required', // Change with appropriate field name
                'id_box_hcr_kotor' => 'required', // Change with appropriate field name
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
                    CabutHancuranPersiapan::create([
                        'id_stock_hcr_kotor'             => $mergedData['id_box_hcr_kotor'],
                        'nomor_job'             => $mergedData['nomor_job'],
                        'jenis_rambang'             => $mergedData['jenis_rambang'],
                        'upah_operator'         => $mergedData['upah_operator'],
                        'berat'           => $mergedData['berat_keluar'] ?? 0,
                        'user_created'          => $mergedData['user_created'],
                        'user_update'           => $mergedData['user_updated'] ?? "There isn't any",
                    ]);

                    CabutHancuranPersiapanStock::create([
                        'nomor_job'             => $mergedData['nomor_job'],
                        'jenis_rambang'             => $mergedData['jenis_rambang'],
                        'upah_operator'         => $mergedData['upah_operator'],
                        'berat_masuk'           => $mergedData['berat_keluar'] ?? 0,
                        'berat_keluar'             => $mergedData['berat_keluars'] ?? 0,
                        'sisa_berat'          => $mergedData['berat_keluar'],
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = RambangBasahStock::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
                    ->where('jenis_rambang', $itemObject->jenis_rambang)
                    ->get();

                    foreach ($existingItems as $existingItem) {
                        // Hitung sisa berat dan sisa pcs
                        $BeratKeluar = $existingItem->berat_keluar + ($itemObject->berat_keluar ?? 0);
                        $sisaBerat = $existingItem->berat_masuk - $BeratKeluar;

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'berat_keluar' => $BeratKeluar,
                            'sisa_berat'   => $sisaBerat,
                            'user_updated' => $itemObject->user_created ?? "There isn't any",
                        ]);
                    }

                    $existingItems = RambangBasahInput::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
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
                        'redirectTo' => route('CabutHancuranPersiapan.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('CabutHancuranPersiapan.index')
        ], 201);
    }

    public function destroy($nomor_job): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan id_box_grading$id_stock_hcr_kotor
            $CabutHancuranPersiapan = CabutHancuranPersiapan::where('nomor_job', '=', $nomor_job)->get();

            if ($CabutHancuranPersiapan->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('CabutHancuranPersiapan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            $PreCleaningS = CabutHancuranPersiapanStock::where('nomor_job', '=', $nomor_job)
                ->first();
            foreach ($CabutHancuranPersiapan as $CabutHancuranPersiapanI) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb

                    if ($PreCleaningS) {
                        // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                        $RambangBasahStock = RambangBasahStock::where('id_box_hcr_kotor', '=', $CabutHancuranPersiapanI->id_stock_hcr_kotor)
                            ->first();

                        if ($RambangBasahStock) {
                            // Simpan nilai sebelum dihapus
                            $beratSebelumnya = $RambangBasahStock->berat_masuk;
                            $beratKeluar = $RambangBasahStock->berat_keluar;
                            
                            // Hitung perbedaan berat dan pcs
                            $perbedaanBerat = $beratKeluar - $CabutHancuranPersiapanI->berat;
                            $sisa_berat = $beratSebelumnya-($perbedaanBerat);

                            // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                            $RambangBasahStock->update([
                                'berat_keluar' => max($perbedaanBerat, 0),
                                'sisa_berat' => max($sisa_berat, 0),
                            ]);
                        }
                    }

                if ($PreCleaningS) {
                    // Hapus data PreCleaningStock
                    $PreCleaningS->delete();
                }

                // Hapus data GradingHalusInput
                $CabutHancuranPersiapanI->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('CabutHancuranPersiapan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('CabutHancuranPersiapan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
