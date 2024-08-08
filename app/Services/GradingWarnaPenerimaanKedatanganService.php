<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\KedatanganOutput;
use App\Models\InputRambangBasah;
use App\Models\RambangBasahStock;
use App\Models\TransitKedatangan;
use App\Models\RambangKeringInput;
use App\Models\RambangKeringStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\GradingWarnaPenerimaanStock;
use App\Models\GradingWarnaPenerimaanKedatangan;

class GradingWarnaPenerimaanKedatanganService
{
    public function store(Request $request)
    {
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'user_created'      => 'required',
            'user_updated'      => 'sometimes',
            'keterangan'        => 'sometimes',
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

                    GradingWarnaPenerimaanKedatangan::create($mergedData);

                    // Tambahkan Jika Butuh Update
                    $GradingWarnaPenerimaanKedatangan = (object) $mergedData;

                    $GradingWarnaPenerimaanStock =  GradingWarnaPenerimaanStock::where('nomor_job', '=', $GradingWarnaPenerimaanKedatangan->nomor_job)
                        ->get();

                    // $found = false;

                    // foreach ($GradingWarnaPenerimaanStock as $item) {
                    //     $found = true;

                    //     // Hitung sisa berat dan sisa pcs
                    //     $beratMasuk = $item->berat_masuk + ($GradingWarna->berat_grading ?? 0);
                    //     $pcsMasuk = $item->pcs_masuk + ($GradingWarna->pcs_grading ?? 0);
                    //     $sisaBerat = $beratMasuk;
                    //     $sisaPcs = $pcsMasuk;
                    //     $totalModal = $item->modal * $sisaBerat;

                    //     // Update data dengan nilai baru
                    //     $item->update([
                    //         'berat_masuk'  => $beratMasuk,
                    //         'pcs_masuk'    => $pcsMasuk,
                    //         'sisa_berat'   => $sisaBerat,
                    //         'sisa_pcs'     => $sisaPcs,
                    //         'total_modal'  => $totalModal,
                    //         'user_updated' => $GradingWarna->user_created ?? "There isn't any",
                    //     ]);
                    // }

                    // if (!$found) {

                    //     GradingWarnaPenerimaanStock::create([
                    //         'nomor_job'             => $mergedData['nomor_job'],
                    //         'nomor_bstb'            => $mergedData['nomor_bstb'],
                    //         'nomor_batch'           => $mergedData['nomor_batch'],
                    //         'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                    //         'keterangan'            => $mergedData['keterangan'],
                    //         'berat_kotor'           => $mergedData['berat_kotor'] ?? 0,
                    //         'jenis_grading'         => $mergedData['jenis_grading'],
                    //         'berat_1_grading'       => $mergedData['berat_1_grading'],
                    //         'pcs_1_grading'         => $mergedData['pcs_1_grading'],
                    //         'berat_2_grading'       => $mergedData['berat_2_grading'] ?? 0,
                    //         'modal'                 => $mergedData['modal'],
                    //         'total_modal'           => $mergedData['total_modal'],
                    //     ]);
                    // }
                    GradingWarnaPenerimaanStock::create([
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'],
                        'berat_kotor'           => $mergedData['berat_kotor'] ?? 0,
                        'jenis_grading'         => $mergedData['jenis_grading'],
                        'berat_1_grading'       => $mergedData['berat_1_grading'],
                        'pcs_1_grading'         => $mergedData['pcs_1_grading'],
                        'berat_2_grading'       => $mergedData['berat_2_grading'] ?? 0,
                        'modal'                 => $mergedData['modal'],
                        'total_modal'           => $mergedData['total_modal'],
                    ]);
                    // Update Status Kedatangan Output
                    $KedatanganOutput = KedatanganOutput::where('nomor_job', '=', $GradingWarnaPenerimaanKedatangan->nomor_job)
                        ->get();
                    foreach ($KedatanganOutput as $item) {
                        $item->update([
                            'status'       => GradingWarnaPenerimaanKedatangan::STATUS_NON_AKTIF,
                        ]);
                    }
                    //Update Status Transit Kedatangan
                    $TransitKedatangan = TransitKedatangan::where('nomor_job', '=', $GradingWarnaPenerimaanKedatangan->nomor_job)
                        ->get();
                    foreach ($TransitKedatangan as $item) {
                        $item->update([
                            'status'       => GradingWarnaPenerimaanKedatangan::STATUS_NON_AKTIF,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingWarnaPenerimaanKedatangan.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('GradingWarnaPenerimaanKedatangan.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Mulai transaksi database
            DB::beginTransaction();

            // Temukan semua record di GradingWarnaPenerimaanKedatangan berdasarkan nomor_job
            $kedatanganItems = GradingWarnaPenerimaanKedatangan::where('nomor_job', $nomor_job)->get();

            if (!$kedatanganItems) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingWarnaPenerimaanKedatangan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            // Ambil nomor_bstb dari semua record yang ditemukan
            $nomor_bstb = $kedatanganItems->pluck('nomor_bstb')->unique();

            // Hapus semua item terkait di GradingWarnaPenerimaanStock dengan nomor_bstb yang sama
            GradingWarnaPenerimaanStock::whereIn('nomor_bstb', $nomor_bstb)->delete();

            // Hapus semua record di GradingWarnaPenerimaanKedatangan dengan nomor_bstb yang sama
            GradingWarnaPenerimaanKedatangan::whereIn('nomor_bstb', $nomor_bstb)->delete();

            // Hapus semua record di GradingWarnaPenerimaanKedatangan berdasarkan nomor_job
            GradingWarnaPenerimaanKedatangan::where('nomor_job', $nomor_job)->delete();

            // Update Status Kedatangan Output
            KedatanganOutput::where('nomor_bstb', $nomor_bstb)
                ->update(['status' => GradingWarnaPenerimaanKedatangan::STATUS_AKTIF]);

            // Update Status Transit Kedatangan
            TransitKedatangan::where('nomor_bstb', $nomor_bstb)
                ->update(['status' => GradingWarnaPenerimaanKedatangan::STATUS_AKTIF]);

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('GradingWarnaPenerimaanKedatangan.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('GradingWarnaPenerimaanKedatangan.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    // public function destroy($id): RedirectResponse
    // {
    //     try {
    //         // Mulai transaksi database
    //         DB::beginTransaction();

    //         // Ambil data item berdasarkan nomor_bstb
    //         $GradingWarnaPenerimaanKedatangan = GradingWarnaPenerimaanKedatangan::find($id);

    //         if (!$GradingWarnaPenerimaanKedatangan) {
    //             // Redirect ke index dengan pesan error jika data tidak ditemukan
    //             return redirect()->route('GradingWarnaPenerimaanKedatangan.index')->with(['error' => 'Data tidak ditemukan!']);
    //         }

    //         // Ambil semua data dengan nomor_batch dan nomor_bstb yang sama dari tabel TransitKedatangan
    //         $GradingWarnaPenerimaanStock = GradingWarnaPenerimaanStock::where('nomor_job', '=', $GradingWarnaPenerimaanKedatangan->nomor_job)
    //             ->where('nomor_bstb', '=', $GradingWarnaPenerimaanKedatangan->nomor_bstb)
    //             ->get();

    //         // Hapus data dari tabel GradingWarnaPenerimaanStock
    //         foreach ($GradingWarnaPenerimaanStock as $item) {
    //             $item->delete();
    //         }

    //         // Hapus data dari tabel GradingWarnaPenerimaanKedatangan
    //         $GradingWarnaPenerimaanKedatangan->delete();

    //         // Update Status Kedatangan Output
    //         $KedatanganOutput = KedatanganOutput::where('nomor_job', '=', $GradingWarnaPenerimaanKedatangan->nomor_job)
    //             ->get();
    //         foreach ($KedatanganOutput as $item) {
    //             $item->update([
    //                 'status'       => GradingWarnaPenerimaanKedatangan::STATUS_AKTIF,
    //             ]);
    //         }

    //         //Update Status Transit Kedatangan
    //         $TransitKedatangan = TransitKedatangan::where('nomor_job', '=', $GradingWarnaPenerimaanKedatangan->nomor_job)
    //             ->get();
    //         foreach ($TransitKedatangan as $item) {
    //             $item->update([
    //                 'status'       => GradingWarnaPenerimaanKedatangan::STATUS_AKTIF,
    //             ]);
    //         }

    //         // Commit transaksi
    //         DB::commit();

    //         // Redirect ke index dengan pesan sukses
    //         return redirect()->route('GradingWarnaPenerimaanKedatangan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // Redirect ke index dengan pesan error
    //         return redirect()->route('GradingWarnaPenerimaanKedatangan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }
}
