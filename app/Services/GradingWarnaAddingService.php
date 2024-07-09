<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\GradingWarnaAdding;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\GradingWarnaPenerimaan;
use App\Models\GradingWarnaAddingStock;
use Illuminate\Support\Facades\Validator;
use App\Models\GradingWarnaPenerimaanStock;

class GradingWarnaAddingService
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

            $validator = Validator::make($data, [
                'nomor_job' => 'required',
                'nomor_lot' => 'required',
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
                    GradingWarnaAdding::create($data);

                    $GradingWarnaAdding = (object) $data;

                    // Ambil semua item yang sesuai dengan kriteria
                    $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarnaAdding->nomor_lot)
                        ->get();

                    $found = false;

                    foreach ($GradingWarnaAddingStock as $item) {
                        $found = true;

                        // Hitung sisa berat dan sisa pcs
                        // $beratMasuk = $item->berat_masuk + ($GradingWarnaAdding->berat_2_grading ?? 0);
                        $beratMasuk = $item->berat_masuk + (($GradingWarnaAdding->berat_1_grading == 0) ? ($GradingWarnaAdding->berat_2_grading ?? 0) : ($GradingWarnaAdding->berat_1_grading ?? 0));
                        $pcsMasuk = $item->pcs_masuk + ($GradingWarnaAdding->pcs_1_grading ?? 0);
                        $sisaBerat = $beratMasuk;
                        $sisaPcs = $pcsMasuk;
                        $totalModal = $item->modal * $sisaBerat;

                        // Update data dengan nilai baru
                        $item->update([
                            'berat_masuk'  => $beratMasuk,
                            'pcs_masuk'    => $pcsMasuk,
                            'sisa_berat'   => $sisaBerat,
                            'sisa_pcs'     => $sisaPcs,
                            'total_modal'  => $totalModal,
                            'user_updated' => $GradingWarnaAdding->user_created ?? "There isn't any",
                        ]);
                    }

                    if (!$found) {
                        // Tentukan berat masuk berdasarkan berat_1_grading atau berat_2_grading
                        $beratMasuk = ($data['berat_1_grading'] == 0) ? ($data['berat_2_grading'] ?? 0) : ($data['berat_1_grading'] ?? 0);
                        $sisaBerat = $beratMasuk;

                        GradingWarnaAddingStock::create([
                            'unit'              => $data['unit'] ?? 'Grading Warna',
                            'nomor_lot'         => $data['nomor_lot'],
                            'nomor_batch'       => $data['nomor_batch'],
                            'tujuan_kirim'       => $data['tujuan_kirim'],
                            // 'berat_masuk'       => $data['berat_2_grading'] ?? 0,
                            'berat_masuk'       => $beratMasuk,
                            'berat_keluar'      => $data['berat_keluar'] ?? 0,
                            // 'sisa_berat'        => $data['berat_2_grading'] ?? 0,
                            'sisa_berat'        => $sisaBerat,
                            'pcs_masuk'         => $data['pcs_1_grading'],
                            'pcs_keluar'        => $data['pcs_keluar'] ?? 0,
                            'sisa_pcs'          => $data['pcs_1_grading'] ?? 0,
                            'modal'             => $data['modal'] ?? 0,
                            'total_modal'       => $data['total_modal'] ?? 0,
                        ]);
                    }

                    // Update Status PenerimaanStock
                    $GradingWarnaPenerimaanStock = GradingWarnaPenerimaanStock::where('nomor_job', '=', $GradingWarnaAdding->nomor_job)
                        ->get();
                    foreach ($GradingWarnaPenerimaanStock as $item) {
                        $item->update([
                            'status'       => GradingWarnaAdding::STATUS_NON_AKTIF,
                        ]);
                    }
                    // Update Status Penerimaan
                    $GradingWarnaPenerimaan = GradingWarnaPenerimaan::where('nomor_job', '=', $GradingWarnaAdding->nomor_job)
                        ->get();
                    foreach ($GradingWarnaPenerimaan as $item) {
                        $item->update([
                            'status'       => GradingWarnaAdding::STATUS_NON_AKTIF,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingWarnaAdding.create')
                    ], 504);
                }
            }
        }
        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('GradingWarnaAdding.index')
        ], 201);
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data item berdasarkan id
            $GradingWarnaAdding = GradingWarnaAdding::find($id);

            if (!$GradingWarnaAdding) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingWarnaAdding.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            // Ambil semua data dengan nomor_job yang sama
            $GradingWarnaAddings = GradingWarnaAdding::where('nomor_job', $GradingWarnaAdding->nomor_job)->get();

            foreach ($GradingWarnaAddings as $item) {
                # code...
                // Ambil data GradingWarnaAddingStock berdasarkan jenis_waste dan tanggal pembuatan yang sesuai
                $GradingWarnaAddingStock = GradingWarnaAddingStock::where('nomor_lot', '=', $GradingWarnaAdding->nomor_lot)
                    ->first();

                if ($GradingWarnaAddingStock) {
                    // Tentukan berat yang akan dikurangi berdasarkan berat_1_grading atau berat_2_grading
                    $beratDikurangi = ($GradingWarnaAdding->berat_1_grading == 0) ? ($GradingWarnaAdding->berat_2_grading ?? 0) : ($GradingWarnaAdding->berat_1_grading ?? 0);

                    // Simpan nilai sebelum dihapus
                    $beratSebelumnya = $GradingWarnaAddingStock->berat_masuk;
                    $pcsSebelumnya = $GradingWarnaAddingStock->pcs_masuk;

                    // Hitung perbedaan berat dan pcs
                    // $beratBaru = $beratSebelumnya - $GradingWarnaAdding->berat_2_grading;
                    $beratBaru = $beratSebelumnya - $beratDikurangi;
                    $pcsBaru = $pcsSebelumnya - $GradingWarnaAdding->pcs_1_grading;
                    $sisaBeratBaru = $GradingWarnaAddingStock->sisa_berat - $beratDikurangi;
                    $sisaPcsBaru = $GradingWarnaAddingStock->sisa_pcs - $GradingWarnaAdding->pcs_1_grading;
                    $totalModal = $GradingWarnaAddingStock->modal * $sisaBeratBaru;

                    if ($sisaBeratBaru <= 0 && $sisaPcsBaru <= 0) {
                        // Hapus data GradingWarnaAddingStock jika sisa_berat dan sisa_pcs baru <= 0
                        $GradingWarnaAddingStock->delete();
                    } else {
                        // Update data GradingWarnaAddingStock dengan berat, pcs, dan sisa yang baru
                        $GradingWarnaAddingStock->update([
                            'berat_masuk'   => $beratBaru,
                            'pcs_masuk'     => $pcsBaru,
                            'sisa_berat'    => $sisaBeratBaru,
                            'sisa_pcs'      => $sisaPcsBaru,
                            'total_modal'   => $totalModal,
                        ]);
                    }
                }
                // Hapus Item GradingWarnaAdding
                $item->delete();
            }

            // Update Status PenerimaanStock
            $GradingWarnaPenerimaanStock = GradingWarnaPenerimaanStock::where('nomor_job', '=', $GradingWarnaAdding->nomor_job)
                ->get();
            foreach ($GradingWarnaPenerimaanStock as $item) {
                $item->update([
                    'status'       => GradingWarnaAdding::STATUS_AKTIF,
                ]);
            }
            // Update Status PenerimaanStock
            $GradingWarnaPenerimaan = GradingWarnaPenerimaan::where('nomor_job', '=', $GradingWarnaAdding->nomor_job)
                ->get();
            foreach ($GradingWarnaPenerimaan as $item) {
                $item->update([
                    'status'       => GradingWarnaAdding::STATUS_AKTIF,
                ]);
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('GradingWarnaAdding.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('GradingWarnaAdding.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
