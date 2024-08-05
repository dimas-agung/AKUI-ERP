<?php

namespace App\Services;

use App\Models\MouldingPenyebaranRework;
use App\Models\MouldingPersiapanRework;
use App\Models\MouldingPersiapanReworkStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\MouldingPenyebaran;
use App\Models\MouldingStock;

class MouldingPenyebaranReworkService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'keterangan' => 'nullable|string',
            'user_created' => 'required',
            'waktu_penyebaran' => 'required'
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
                'nomor_job_rework' => 'required', // Ganti dengan nama field yang sesuai
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

                    // Buat instansi PreCleaningInput
                    MouldingPenyebaranRework::create(array_merge($mergedData, [
                        'waktu_penyebaran' => $validatedData['waktu_penyebaran'],
                        'keterangan'       => $validatedData['keterangan'],
                        'user_created'       => $validatedData['user_created'],
                    ]));

                    // $MouldingPenyebaranRework = (object) $mergedData;

                    // // Ambil semua item yang sesuai dengan kriteria
                    // $MouldingPersiapanStock = MouldingPersiapanReworkStock::where('nomor_job_rework', $MouldingPenyebaranRework->nomor_job_rework)
                    //     ->get();

                    // foreach ($MouldingPersiapanStock as $item) {

                    //     // Update data dengan nilai baru
                    //     $item->update([
                    //         'status'       => MouldingPenyebaranRework::STATUS_ON_PROSES,
                    //     ]);
                    // }

                    // // Ambil semua item yang sesuai dengan kriteria
                    // $MouldingPersiapan = MouldingPersiapanRework::where('nomor_job_rework', $MouldingPenyebaranRework->nomor_job_rework)
                    //     ->get();

                    // foreach ($MouldingPersiapan as $item) {

                    //     // Update data dengan nilai baru
                    //     $item->update([
                    //         'status'       => $item->status ?? 0,
                    //     ]);
                    // }


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('MouldingReworkPenyebaran.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('MouldingReworkPenyebaran.index')
        ], 201);
    }

    // public function destroy($nomor_job)
    // {
    //     try {
    //         // Gunakan transaksi database untuk memastikan konsistensi
    //         DB::beginTransaction();

    //         // Ambil data PreCleaningInput berdasarkan nomor_job
    //         $MouldingPenyebaran = MouldingPenyebaran::where('nomor_job', '=', $nomor_job)->get();

    //         if ($MouldingPenyebaran->isEmpty()) {
    //             // Redirect ke index dengan pesan error jika data tidak ditemukan
    //             return redirect()->route('MouldingPenyebaran.index')->with(['error' => 'Data tidak ditemukan!']);
    //         }

    //         foreach ($MouldingPenyebaran as $mouldingPenyebaran) {
    //             // Hapus data PreGradingHalusInput
    //             $mouldingPenyebaran->delete();

    //             // Perbarui status PreCleaningOutput jika ada
    //             $MouldingStock = MouldingStock::where('nomor_job', '=', $nomor_job)->get();

    //             foreach ($MouldingStock as $mouldingStock) {
    //                 // Update status menjadi 1 pada MouldingStock
    //                 $mouldingStock->update(['status' => MouldingStock::STATUS_ON_STOCK]);
    //             }
    //         }

    //         // Commit transaksi
    //         DB::commit();

    //         // Redirect ke index dengan pesan sukses
    //         return redirect()->route('MouldingPenyebaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // Redirect ke index dengan pesan error
    //         return redirect()->route('MouldingPenyebaran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }
}
