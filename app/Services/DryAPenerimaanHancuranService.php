<?php
namespace App\Services;

use App\Models\CabutBuluPengembalian;
use App\Models\DryAPenerimaanCabut;
use App\Models\DryAPenerimaanCabutStock;
use App\Models\DryAPenerimaanHancuran;
use App\Models\DryAPenerimaanHancuranStock;
use App\Models\CabutHancuranPengembalian;
use App\Models\PreGradingHalusAddingStock;
use App\Models\TransitCabutBulu;
use App\Models\TransitCabutBuluHancuran;
use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class DryAPenerimaanHancuranService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau data susut atau kontribusi kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }


        // Loop through each item in dataArray
        foreach ($dataArray as $key => $data) {
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data);

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                'nomor_job' => 'required', // Change with appropriate field name
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
                    DryAPenerimaanHancuran::create($mergedData);

                    $grading = DryAPenerimaanHancuranStock::where('nomor_job', $mergedData['nomor_job'])
                        ->first();

                    if ($grading) {

                        // Update existing grading data
                        $grading->update([
                            'berat'       => $grading->berat + ($mergedData['berat'] ?? 0),
                        ]);
                    } else {
                        // Create new grading data
                        DryAPenerimaanHancuranStock::create([
                            'unit'             => $mergedData['unit'] ?? 'Dry A Hancuran',
                            'nomor_job'             => $mergedData['nomor_job'],
                            'jenis_rambang'         => $mergedData['jenis_rambang'],
                            'upah_operator'         => $mergedData['upah_operator'],
                            'berat'                 => $mergedData['berat'],
                            'nama_operator'         => $mergedData['nama_operator'] ?? 0,
                            'nip_operator'          => $mergedData['nip_operator'] ?? 0,
                            'grade_operator'        => $mergedData['grade_operator'] ?? 0,
                            'nama_team_leader'      => $mergedData['nama_team_leader'] ?? 0,
                            'waktu_penyebaran'      => $mergedData['waktu_penyebaran'] ?? 0,
                            'waktu_pengembalian'    => $mergedData['waktu_pengembalian'] ?? 0,
                        ]);
                    }

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = TransitCabutBuluHancuran::where('nomor_job', $itemObject->nomor_job)
                        ->where('jenis_rambang', $itemObject->jenis_rambang)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'status'    => $itemObject->statuss ?? 0,
                            'berat' => $itemObject->berats ?? 0,
                        ]);
                    }

                    $existingItems = CabutHancuranPengembalian::where('nomor_job', $itemObject->nomor_job)
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
                        'redirectTo' => route('DryAPenerimaanHancuran.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAPenerimaanHancuran.index')
        ], 201);
    }

    public function destroy($nomor_job): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_job
            $GradingHalusInputs = DryAPenerimaanHancuran::where('nomor_job', '=', $nomor_job)->get();

            if ($GradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('DryAPenerimaanHancuran.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($GradingHalusInputs as $PreCleaningI) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = DryAPenerimaanHancuranStock::where('nomor_job', '=', $PreCleaningI->nomor_job)->get();

                if (!$PreCleaningS->isEmpty()) {
                    foreach ($PreCleaningS as $stockItem) {
                        // Ambil data StockTransitGradingKasar berdasarkan nomor job
                        $stockPrmRawMaterial = TransitCabutBuluHancuran::where('nomor_job', '=', $stockItem->nomor_job)->get();

                        if (!$stockPrmRawMaterial->isEmpty()) {
                            foreach ($stockPrmRawMaterial as $transitItem) {
                                // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                                $transitItem->update([
                                    'berat' => max($PreCleaningI->berat, 0),
                                    'status' => 1,
                                ]);
                            }
                        }

                        // Hapus data PreCleaningStock
                        $stockItem->delete();
                    }
                }

                // Update data CabutHancuranPengembalian
                $existingItems = CabutHancuranPengembalian::where('nomor_job', $PreCleaningI->nomor_job)->get();

                $dataToUpdate = [
                    'status' => $PreCleaningI->status ?? 1,
                ];

                if (!$existingItems->isEmpty()) {
                    foreach ($existingItems as $existingItem) {
                        $existingItem->update($dataToUpdate);
                    }
                }

                // Hapus data GradingHalusInput
                $PreCleaningI->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAPenerimaanHancuran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAPenerimaanHancuran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
