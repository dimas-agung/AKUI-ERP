<?php
namespace App\Services;

use App\Models\CabutBuluPengembalian;
use App\Models\DryAGradingHancuran;
use App\Models\DryAGradingHancuranStock;
use App\Models\DryAOutputHancuran;
use App\Models\TransitDryAHancuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class DryAOutputHancuranService
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
                'jenis_grading' => 'required', // Change with appropriate field name
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
                    DryAOutputHancuran::create($mergedData);

                    $grading = TransitDryAHancuran::where('jenis_grading', $mergedData['jenis_grading'])
                        ->first();

                    if ($grading) {

                        // Update existing grading data
                        $grading->update([
                            'berat_job'       => $grading->berat_job + ($mergedData['berat_job'] ?? 0),
                        ]);
                    } else {
                        // Create new grading data
                        TransitDryAHancuran::create([
                            'unit'             => $mergedData['unit'] ?? 'Dry A Hancuran',
                            'jenis_grading'    => $mergedData['jenis_grading'],
                            'berat_job'        => $mergedData['berat_job'],
                            'nomor_job'        => $mergedData['nomor_job'],
                            'nomor_bstb'       => $mergedData['nomor_bstb'],
                            'tujuan_kirim'     => $mergedData['tujuan_kirim'] ?? 0,
                            'modal'            => $mergedData['modal'] ?? 0,
                            'total_modal'      => $mergedData['total_modal'] ?? 0,
                            'status'           => $mergedData['status'] ?? 1,
                        ]);
                    }

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = DryAGradingHancuranStock::where('jenis_grading', $itemObject->jenis_grading)
                        ->get();

                    foreach ($existingItems as $existingItem) {
                        $beratKeluar = $existingItem->berat_keluar + ($itemObject->berat_job);
                        $sisaBerat = $existingItem->berat_masuk - $beratKeluar;
                        $totalModal = $existingItem->modal * $sisaBerat;

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'berat_keluar'  => $beratKeluar ?? 0,
                            'sisa_berat'    => $sisaBerat ?? 0,
                            'total_modal'    => $totalModal,
                        ]);
                    }

                    $existingItems = DryAGradingHancuran::where('jenis_grading', $itemObject->jenis_grading)
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
                        'redirectTo' => route('DryAOutputHancuran.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAOutputHancuran.index')
        ], 201);
    }

    public function destroy($jenis_grading): RedirectResponse
    {
        try {
            Log::info('Mencoba hapus: ' . $jenis_grading);

            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data DryAOutputHancuran berdasarkan jenis_grading
            $DryAOutputHancuranRecords = DryAOutputHancuran::where('jenis_grading', '=', $jenis_grading)->get();

            if ($DryAOutputHancuranRecords->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('DryAOutputHancuran.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($DryAOutputHancuranRecords as $outputRecord) {
                // Ambil data TransitDryAHancuran berdasarkan jenis_grading
                $transitDryAHancuranRecords = TransitDryAHancuran::where('jenis_grading', '=', $outputRecord->jenis_grading)->get();

                foreach ($transitDryAHancuranRecords as $transitRecord) {
                    // Ambil data DryAGradingHancuranStock berdasarkan jenis_grading
                    $stockRecords = DryAGradingHancuranStock::where('jenis_grading', '=', $transitRecord->jenis_grading)->get();

                    foreach ($stockRecords as $stockRecord) {
                        // Simpan nilai sebelum dihapus
                        $beratSebelumnya = $stockRecord->berat_masuk;

                        // Hitung perbedaan berat dan pcs
                        $perbedaanBerat = $transitRecord->berat_job;

                        // Hitung total modal baru
                        $beratKeluar = $stockRecord->berat_keluar - $perbedaanBerat;
                        $beratSisa = $beratSebelumnya - $beratKeluar;
                        $totalModal = $transitRecord->modal * $beratSisa;

                        // Update data DryAGradingHancuranStock
                        $stockRecord->update([
                            'berat_keluar' => max($beratKeluar, 0),
                            'sisa_berat' => max($beratSisa, 0),
                            'total_modal' => max($totalModal, 0)
                        ]);
                    }

                    // Hapus data TransitDryAHancuran
                    $transitRecord->delete();
                }

                // Update data DryAGradingHancuran
                $gradingRecords = DryAGradingHancuran::where('jenis_grading', $outputRecord->jenis_grading)->get();
                foreach ($gradingRecords as $gradingRecord) {
                    $gradingRecord->update(['status' => $outputRecord->status ?? 1]);
                }

                // Hapus data DryAOutputHancuran
                $outputRecord->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAOutputHancuran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAOutputHancuran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
