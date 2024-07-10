<?php
namespace App\Services;

use App\Models\CabutBuluPengembalian;
use App\Models\DryAGradingHancuran;
use App\Models\DryAGradingHancuranStock;
use App\Models\DryAOutputHancuran;
use App\Models\GradingWarna;
use App\Models\GradingWarnaStock;
use App\Models\Moulding;
use App\Models\MouldingPersiapan;
use App\Models\MouldingStock;
use App\Models\TransitDryAHancuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class MouldingPersiapanService
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
                'id_box_grading_warna' => 'required', // Change with appropriate field name
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

                    // Create instance of MouldingPersiapan
                    MouldingPersiapan::create($mergedData);

                    // Check if GradingWarnaStock table contains id_box_grading_warna
                    $grading = GradingWarnaStock::where('id_box_grading_warna', $mergedData['id_box_grading_warna'])
                        ->first();

                    if ($grading) {
                        // Hitung total modal baru
                        $beratKeluar = ($mergedData['berat_job'] ?? 0);
                        $beratSisa = $grading->berat_masuk - $beratKeluar;
                        $pcsKeluar = ($mergedData['pcs_job'] ?? 0);
                        $pcsSisa = $grading->pcs_masuk- $pcsKeluar;
                        $totalModal = $grading->modal * $beratSisa;

                        // Update existing grading data
                        $grading->update([
                            'berat_keluar'       => ($mergedData['berat_job'] ?? 0),
                            'sisa_berat'         => $beratSisa,
                            'pcs_keluar'         => ($mergedData['pcs_job'] ?? 0),
                            'sisa_pcs'           => $pcsSisa,
                            'total_modal'        => $totalModal,
                            'status'             => ($mergedData['statuss'] ?? 0),
                        ]);
                    }

                    // Check if GradingWarna table contains id_box_grading_warna
                    $existingItems = GradingWarna::where('id_box_grading_warna', $mergedData['id_box_grading_warna'])
                        ->get();

                    $dataToUpdate = [
                        'status' => $mergedData['status'] ?? 0,
                    ];

                    if ($existingItems) {
                        foreach ($existingItems as $existingItem) {
                            $existingItem->update($dataToUpdate);
                        }
                    }

                    // Creat Prm Raw Material Stock
                    $itemObject = (object)$mergedData;
                    $existingItem = Moulding::where('nomor_job', $itemObject->nomor_job)->first();

                    if ($existingItem) {
                        // Jika item dengan nomor_job yang sama ada, tambahkan berat_job dan pcs_job
                        $existingItem->update([
                            'berat_job' => $existingItem->berat_job + $itemObject->berat_job,
                            'pcs_job' => $existingItem->pcs_job + $itemObject->pcs_job,
                        ]);
                    } else {
                        // Jika item dengan nomor_job yang sama tidak ada, buat item baru dalam database
                        Moulding::create([
                            'nomor_job' => $itemObject->nomor_job,
                            'job_order' => $itemObject->job_order,
                            'tujuan_kirim' => $itemObject->tujuan_kirim,
                            'nomor_batch' => $itemObject->nomor_batch,
                            'upah_operator' => $itemObject->upah_operator,
                            'modal_nomor_job' => $itemObject->modal_nomor_job,
                            'total_modal_nomor_job' => $itemObject->total_modal_nomor_job,
                            'user_created' => $itemObject->user_created,
                            'berat_job' => $itemObject->berat_job,
                            'pcs_job' => $itemObject->pcs_job,
                        ]);
                    }
                    $MouldingStock = MouldingStock::where('nomor_job', $itemObject->nomor_job)->first();

                    if ($MouldingStock) {
                        // Jika item dengan nomor_job yang sama ada, tambahkan berat_job dan pcs_job
                        $MouldingStock->update([
                            'berat_job' => $MouldingStock->berat_job + $itemObject->berat_job,
                            'pcs_job' => $MouldingStock->pcs_job + $itemObject->pcs_job,
                        ]);
                    } else {
                        // Jika item dengan nomor_job yang sama tidak ada, buat item baru dalam database
                        MouldingStock::create([
                            'nomor_job' => $itemObject->nomor_job,
                            'job_order' => $itemObject->job_order,
                            'tujuan_kirim' => $itemObject->tujuan_kirim,
                            'nomor_batch' => $itemObject->nomor_batch,
                            'upah_operator' => $itemObject->upah_operator,
                            'modal_nomor_job' => $itemObject->modal_nomor_job,
                            'total_modal_nomor_job' => $itemObject->total_modal_nomor_job,
                            'user_created' => $itemObject->user_created,
                            'berat_job' => $itemObject->berat_job,
                            'pcs_job' => $itemObject->pcs_job,
                        ]);
                    }


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('MouldingPersiapan.create')
                    ], 504);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'redirectTo' => route('MouldingPersiapan.index')
        ], 200);
    }

    public function destroy($nomor_job): RedirectResponse
    {
        try {
            Log::info('Mencoba hapus: ' . $nomor_job);

            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data DryAOutputHancuran berdasarkan jenis_grading
            $DryAOutputHancuranRecords = MouldingPersiapan::where('nomor_job', '=', $nomor_job)->get();

            if ($DryAOutputHancuranRecords->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('MouldingPersiapan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($DryAOutputHancuranRecords as $outputRecord) {
                // Ambil data TransitDryAHancuran berdasarkan jenis_grading
                $transitDryAHancuranRecords = GradingWarnaStock::where('id_box_grading_warna', '=', $outputRecord->id_box_grading_warna)->get();

                foreach ($transitDryAHancuranRecords as $transitRecord) {
                        // Simpan nilai sebelum dihapus
                        $beratSebelumnya = $transitRecord->berat_masuk;
                        $pcsSebelumnya = $transitRecord->pcs_masuk;

                        // Hitung perbedaan berat dan pcs
                        $perbedaanBerat = $outputRecord->berat_job;
                        $perbedaanPcs = $outputRecord->pcs_job;

                        // Hitung total modal baru
                        $beratKeluar = $transitRecord->berat_keluar - $perbedaanBerat;
                        $beratSisa = $beratSebelumnya - $beratKeluar;
                        $pcsKeluar = $transitRecord->pcs_keluar - $perbedaanPcs;
                        $pcsSisa = $pcsSebelumnya - $pcsKeluar;
                        $totalModal = $transitRecord->modal * $beratSisa;

                        // Update data DryAGradingHancuranStock
                        $transitRecord->update([
                            'berat_keluar' => max($beratKeluar, 0),
                            'sisa_berat' => max($beratSisa, 0),
                            'pcs_keluar' => max($pcsKeluar, 0),
                            'sisa_pcs' => max($pcsSisa, 0),
                            'total_modal' => max($totalModal, 0),
                            'status' => max($outputRecord->statuss, 1)
                        ]);
                }

                // Update data DryAGradingHancuran
                $gradingRecords = GradingWarna::where('id_box_grading_warna', $outputRecord->id_box_grading_warna)->get();
                foreach ($gradingRecords as $gradingRecord) {
                    $gradingRecord->update(['status' => $outputRecord->status ?? 1]);
                }

                // Hapus data DryAOutputHancuran
                $outputRecord->delete();
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('MouldingPersiapan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('MouldingPersiapan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
