<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\PreWashOutput;
use App\Models\CabutBuluPenerimaan;
use App\Models\CabutBuluStock;
use App\Models\TransitPreWash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class CabutBuluPenerimaanService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'user_created' => 'required',
        ]);

        // Check if $dataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        // Loop melalui setiap item dalam dataArray
        foreach ($dataArray as $data) {
            // Gabungkan data dari $validatedData dan $data
            $mergedData = array_merge($validatedData, $data);

            // Validasi untuk setiap item dalam dataArray
            $validator = Validator::make($mergedData, [
                'nomor_bstb' => 'required', // Ganti dengan nama field yang sesuai
                // ... tambahkan validasi lain sesuai kebutuhan
            ]);

            // Jika validasi gagal, kembalikan pesan error
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                ], 400);
            } else {
                try {
                    DB::beginTransaction();

                    // Buat instansi CabutPnput
                    CabutBuluPenerimaan::create($mergedData);

                    CabutBuluStock::create([
                        'workstation'       => $mergedData['workstation'] ?? 'Cleaning',
                        'unit'              => $mergedData['unit'] ?? 'Cabut Bulu',
                        'nomor_job'         => $mergedData['nomor_job'],
                        'nomor_bstb'        => $mergedData['nomor_bstb'],
                        'nomor_batch'       => $mergedData['nomor_batch'],
                        'jenis_job'         => $mergedData['jenis_job'],
                        'berat_job'         => $mergedData['berat_job'] ?? 0,
                        'pcs_job'           => $mergedData['pcs_job'] ?? 0,
                        'upah_operator'     => $mergedData['upah_operator'] ?? 0,
                        'tujuan_kirim'      => $mergedData['tujuan_kirim'],
                        'keterangan'        => $mergedData['keterangan'],
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                        'user_created'      => $mergedData['user_created'],
                        'user_update'       => $mergedData['user_updated'] ?? `" "`,
                        'status'            => $mergedData['status'] ?? 1
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = TransitPreWash::where('nomor_job', $itemObject->nomor_job)
                        ->where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data TransitPreCleaningStock
                            'berat_job' => $itemObject->berat_jobs ?? 0,
                            'pcs_job'   => $itemObject->pcs_jobs ?? 0,
                            'user_updated' => $itemObject->user_created ?? " ",
                            'status' => 0,
                        ]);
                    }

                    $existingItems = PreWashOutput::where('nomor_job', $itemObject->nomor_job)
                    ->where('nomor_bstb', $itemObject->nomor_bstb)
                    ->get();

                    $dataToUpdate = [
                        'status'                => CabutBuluPenerimaan::STATUS_ON_STOCK,
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
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('CabutBuluPenerimaan.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('CabutBuluPenerimaan.index')
        ], 201);
    }

    public function destroy($nomor_bstb): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data CabutPnput berdasarkan nomor_bstb
            $CabutPenerimaan = CabutBuluPenerimaan::where('nomor_bstb', '=', $nomor_bstb)->get();

            if ($CabutPenerimaan->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('CabutBuluPenerimaan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($CabutPenerimaan as $CabutP) {
                // Ambil data PreCleaningStock berdasarkan id_box_grading_kasar dan id_box_raw_material
                $PreCleaningS = CabutBuluStock::where('nomor_job', '=', $CabutP->nomor_job)
                    ->first();

                if ($PreCleaningS) {
                    // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                    $transitPreWash = TransitPreWash::where('nomor_bstb', '=', $CabutP->nomor_bstb)
                        ->where('nomor_job', '=', $CabutP->nomor_job)
                        ->first();

                    if ($transitPreWash) {
                        // Simpan nilai sebelum dihapus
                        $beratSebelumnya = $transitPreWash->berat_job;
                        $pcsSebelumnya = $transitPreWash->pcs_job;

                        // Hitung perbedaan berat dan pcs
                        $perbedaanBerat = $CabutP->berat_job;
                        $perbedaanPcs = $CabutP->pcs_job;

                        // Hitung total modal baru
                        // $totalModalBaru = $totalModalSebelumnya - ($beratSebelumnya * $CabutP->modal);

                        // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                        $transitPreWash->update([
                            'berat_job' => max($beratSebelumnya - $perbedaanBerat, 0),
                            'pcs_job' => max($pcsSebelumnya - $perbedaanPcs, 0),
                            'status' => 1,
                            // 'total_modal' => max($totalModalBaru, 0),
                        ]);
                    }
                }

                // Simpan data sebelum dihapus
                $beratSebelumHapus = $CabutP->berat_job;
                $pcsSebelumHapus = $CabutP->pcs_job;
                $totalModalSebelumHapus = $CabutP->total_modal;

                // Hapus data CabutPnput dan PreCleaningStock
                $CabutP->delete();
                if ($PreCleaningS) {
                    $PreCleaningS->delete();
                }

                // Kembalikan nilai sebelum dihapus
                if ($transitPreWash) {
                    $transitPreWash->update([
                        'berat_job' => $transitPreWash->berat_job + $beratSebelumHapus,
                        'pcs_job' => $transitPreWash->pcs_job + $pcsSebelumHapus
                    ]);
                }

                $existingItems = PreWashOutput::where('nomor_bstb', $CabutP->nomor_bstb)
                ->where('nomor_job', $CabutP->nomor_job)
                ->get();

                // Logika Update Status
                if ($existingItems) {
                    foreach ($existingItems as $existingItem) {
                        // Perbarui data untuk setiap item yang ada
                        $existingItem->update(['status' => CabutBuluPenerimaan::STATUS_ON_STOCK]);
                    }
                } else {
                    // Jika tidak ada item PreWashOutput yang sesuai, buat baru dengan status 1
                    PreWashOutput::create([
                        'nomor_bstb' => $CabutP->nomor_bstb,
                        'status' => 1,
                        // Tambahkan kolom-kolom lain sesuai kebutuhan
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('CabutBuluPenerimaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('CabutBuluPenerimaan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
