<?php
namespace App\Services;

use App\Models\FinalGrading;
use App\Models\GradingWarna;
use App\Models\GradingWarnaStock;
use App\Models\Moulding;
use App\Models\MouldingPersiapan;
use App\Models\MouldingPersiapanRework;
use App\Models\MouldingPersiapanReworkStock;
use App\Models\MouldingStock;
use App\Models\TransitFinalGradingRework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class MouldingPersiapanReworkService
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
                'nomor_job_rework' => 'required', // Change with appropriate field name
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

                    // Create instance of MouldingPersiapan
                    MouldingPersiapanRework::create($mergedData);

                    // Convert $mergedData to object
                    $itemObject = (object)$mergedData;

                    // Ambil item dengan nomor_job_rework yang sesuai
                    $MouldingStock = MouldingPersiapanReworkStock::where('nomor_job_rework', $itemObject->nomor_job_rework)->first();

                    if ($MouldingStock) {
                        // Jika item dengan nomor_job yang sama ada, tambahkan berat_job dan pcs_job
                        $MouldingStock->update([
                            'berat_job' => $MouldingStock->berat_job + $itemObject->berat_job,
                            'pcs_job' => $MouldingStock->pcs_job + $itemObject->pcs_job,
                        ]);
                    } else {
                        // Jika item dengan nomor_job yang sama tidak ada, buat item baru dalam database
                        MouldingPersiapanReworkStock::create([
                            'unit' => $itemObject->unit ?? 'Moulding Rework Persiapan',
                            'nomor_job_rework' => $itemObject->nomor_job_rework,
                            'nomor_batch' => $itemObject->nomor_batch,
                            'tujuan_kirim' => $itemObject->tujuan_kirim,
                            'job_order' => $itemObject->job_order,
                            'berat_job' => $itemObject->berat_job,
                            'pcs_job' => $itemObject->pcs_job,
                            'modal' => $itemObject->modal,
                            'total_modal' => $itemObject->total_modal,
                            'nama_operator' => $itemObject->nama_operator,
                            'nip_operator' => $itemObject->nip_operator,
                            'grade_operator' => $itemObject->grade_operator,
                            'nama_team_leader' => $itemObject->nama_team_leader
                        ]);
                    }
                    // Check if FinalGrading table contains nomor_job_rework
                    $existingItems = FinalGrading::where('nomor_job_rework', $itemObject->nomor_job_rework)->get();

                    $dataToUpdate = [
                        'status' => $itemObject->status ?? 0,
                    ];
                    // Check if TransitFinal table contains nomor_job_rework
                    $existingItems = TransitFinalGradingRework::where('nomor_job_rework', $itemObject->nomor_job_rework)->get();

                    $dataToUpdate = [
                        'status' => $itemObject->status ?? 0,
                    ];

                    if ($existingItems->count() > 0) {
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
                        'redirectTo' => route('MouldingReworkPersiapan.create')
                    ], 504);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'redirectTo' => route('MouldingReworkPersiapan.index')
        ], 200);
    }

    public function destroy($nomor_job_rework): RedirectResponse
    {
        try {
            Log::info('Mencoba hapus: ' . $nomor_job_rework);

            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data DryAOutputHancuran berdasarkan jenis_grading
            $MouldingPR = MouldingPersiapanRework::where('nomor_job_rework', '=', $nomor_job_rework)->get();

            if ($MouldingPR->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('MouldingReworkPersiapan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($MouldingPR as $outputRecord) {
                // Ambil data TransitDryAHancuran berdasarkan jenis_grading
                $MouldingPRS = MouldingPersiapanReworkStock::where('nomor_job_rework', '=', $outputRecord->nomor_job_rework)->get();
                // $MouldingPRS->delete();
                foreach ($MouldingPRS as $MouldingStock) {
                    $MouldingStock->delete();
                }

                // Update data 
                 // Check if FinalGrading table contains nomor_job_rework
                 $existingItems = FinalGrading::where('nomor_job_rework', $outputRecord->nomor_job_rework)->get();

                 $dataToUpdate = [
                     'status' => $itemObject->status ?? 0,
                 ];
                $TransitFGR = TransitFinalGradingRework::where('nomor_job_rework', $outputRecord->nomor_job_rework)->get();
                foreach ($TransitFGR as $gradingRecord) {
                    $gradingRecord->update(['status' => $outputRecord->status ?? 1]);
                }

                // Hapus data DryAOutputHancuran
                $outputRecord->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('MouldingReworkPersiapan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('MouldingReworkPersiapan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
