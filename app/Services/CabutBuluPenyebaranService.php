<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\CabutBuluPenerimaan;
use App\Models\CabutBuluPenyebaran;
use App\Models\CabutBuluStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class CabutBuluPenyebaranService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
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
                // Ganti dengan nama field yang sesuai
                'nomor_job' => 'required',
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
                    CabutBuluPenyebaran::create(array_merge($mergedData, ['waktu_penyebaran' => $validatedData['waktu_penyebaran']]));

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = CabutBuluStock::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'status'       => CabutBuluPenyebaran::STATUS_ON_PROSES,
                        ]);
                    }

                    // Ambil semua item yang sesuai dengan kriteria
                    $CabutPenerimaan = CabutBuluPenerimaan::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($CabutPenerimaan as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'       => CabutBuluPenyebaran::STATUS_NON_AKTIF,
                        ]);
                    }


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('CabutBuluPenyebaran.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('CabutBuluPenyebaran.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_job
            $CabutBuluPenyebaran = CabutBuluPenyebaran::where('nomor_job', '=', $nomor_job)->get();

            if ($CabutBuluPenyebaran->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('CabutBuluPenyebaran.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($CabutBuluPenyebaran as $cabutPenyebaran) {
                // Hapus data PreGradingHalusInput
                $cabutPenyebaran->delete();

                // Perbarui status PreCleaningOutput jika ada
                $CabutBuluStock = CabutBuluStock::where('nomor_job', '=', $nomor_job)->get();

                foreach ($CabutBuluStock as $cabutStock) {
                    // Update status menjadi 1 pada CabutBuluStock
                    $cabutStock->update(['status' => CabutBuluPenyebaran::STATUS_ON_STOCK]);
                }
            }

            foreach ($CabutBuluPenyebaran as $cabutPenyebaran) {
                // Hapus data PreGradingHalusInput
                $cabutPenyebaran->delete();

                // Perbarui status PreCleaningOutput jika ada
                $CabutBuluPenerimaan = CabutBuluPenerimaan::where('nomor_job', '=', $nomor_job)->get();

                foreach ($CabutBuluPenerimaan as $cabutPenerimaan) {
                    // Update status menjadi 1 pada CabutBuluStock
                    $cabutPenerimaan->update(['status' => CabutBuluPenyebaran::STATUS_ON_STOCK]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('CabutBuluPenyebaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('CabutBuluPenyebaran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
