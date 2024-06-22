<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\PreWashOutput;
use App\Models\CabutBuluStock;
use App\Models\TransitPreWash;
use Illuminate\Support\Facades\DB;
use App\Models\CabutBuluPenerimaan;
use App\Models\CabutBuluPenyebaran;
use Illuminate\Http\RedirectResponse;
use App\Models\CabutHancuranPersiapan;
use App\Models\CabutHancuranPenyebaran;
use Illuminate\Support\Facades\Validator;
use App\Models\CabutHancuranPersiapanStock;

class CabutHancuranPenyebaranService
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
                'nomor_job' => 'required', // Ganti dengan nama field yang sesuai
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
                    CabutHancuranPenyebaran::create(array_merge($mergedData, ['waktu_penyebaran' => $validatedData['waktu_penyebaran']]));

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = CabutHancuranPersiapanStock::where('nomor_job', $itemObject->nomor_job)
                        // ->where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data TransitPreCleaningStock
                            'status'       => $itemObject->status ?? 2,
                            // 'user_updated' => $itemObject->user_created ?? " ",
                        ]);
                    }

                    $CabutHancuranPersiapan = CabutHancuranPersiapan::where('nomor_job', $itemObject->nomor_job)
                        // ->where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($CabutHancuranPersiapan as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            // Update data TransitPreCleaningStock
                            'status'       => $itemObject->status ?? 0,
                            // 'user_updated' => $itemObject->user_created ?? " ",
                        ]);
                    }


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('CabutHancuranPenyebaran.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('CabutHancuranPenyebaran.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_job
            $CabutHancuranPenyebaran = CabutHancuranPenyebaran::where('nomor_job', '=', $nomor_job)->get();

            if ($CabutHancuranPenyebaran->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('CabutHancuranPenyebaran.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($CabutHancuranPenyebaran as $cabutPenyebaran) {
                // Hapus data PreGradingHalusInput
                $cabutPenyebaran->delete();

                // Perbarui status PreCleaningOutput jika ada
                $CabutHancuranPersiapanStock = CabutHancuranPersiapanStock::where('nomor_job', '=', $nomor_job)->get();

                foreach ($CabutHancuranPersiapanStock as $cabutStock) {
                    // Update status menjadi 1 pada CabutHancuranPersiapanStock
                    $cabutStock->update(['status' => 1]);
                }

                // Perbarui status PreCleaningOutput jika ada
                $CabutHancuranPersiapan = CabutHancuranPersiapan::where('nomor_job', '=', $nomor_job)->get();

                foreach ($CabutHancuranPersiapan as $item) {
                    // Update status menjadi 1 pada CabutHancuranPersiapan
                    $item->update(['status' => 1]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('CabutHancuranPenyebaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('CabutHancuranPenyebaran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
