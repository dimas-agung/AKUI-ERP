<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\RambangBasahStock;
use App\Models\RambangKeringInput;
use App\Models\RambangKeringStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class RambangKeringInputService
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
                'id_box_hcr_kotor' => 'required', // Ganti dengan nama field yang sesuai
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
                    RambangKeringInput::create($mergedData);
                    // RambangKeringInput::create(array_merge($mergedData, ['waktu_penyebaran' => $validatedData['waktu_penyebaran']]));

                    RambangKeringStock::create([
                        'unit'                  => $mergedData['unit'] ?? 'Cleaning',
                        'id_box_hcr_kotor'      => $mergedData['id_box_hcr_kotor'],
                        'jenis_rambang'         => $mergedData['jenis_rambang'],
                        'berat_masuk'           => $mergedData['berat_kering'],
                        'berat_keluar'          => $mergedData['berat_keluar'] ?? 0,
                        'sisa_berat'            => $mergedData['berat_kering'],
                        'user_created'          => $mergedData['user_created'],
                    ]);

                    // Tambahkan Jika Butuh Update
                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = RambangBasahStock::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
                        ->where('jenis_rambang', $itemObject->jenis_rambang)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'berat_keluar'      => $itemObject->berat_basah,
                            'sisa_berat'        => $existingItem->berat_masuk - $existingItem->berat_keluar,
                            // 'user_updated' => $itemObject->user_created ?? " ",
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('RambangKeringInput.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('RambangKeringInput.index')
        ], 201);
    }

    // public function destroy($nomor_job)
    // {
    //     try {
    //         // Gunakan transaksi database untuk memastikan konsistensi
    //         DB::beginTransaction();

    //         // Ambil data PreCleaningInput berdasarkan nomor_job
    //         $CabutBuluPenyebaran = RambangKeringInput::where('nomor_job', '=', $nomor_job)->get();

    //         if ($CabutBuluPenyebaran->isEmpty()) {
    //             // Redirect ke index dengan pesan error jika data tidak ditemukan
    //             return redirect()->route('CabutBuluPenyebaran.index')->with(['error' => 'Data tidak ditemukan!']);
    //         }

    //         foreach ($CabutBuluPenyebaran as $cabutPenyebaran) {
    //             // Hapus data PreGradingHalusInput
    //             $cabutPenyebaran->delete();

    //             // Perbarui status PreCleaningOutput jika ada
    //             $CabutBuluStock = CabutBuluStock::where('nomor_job', '=', $nomor_job)->get();

    //             foreach ($CabutBuluStock as $cabutStock) {
    //                 // Update status menjadi 1 pada CabutBuluStock
    //                 $cabutStock->update(['status' => 1]);
    //             }
    //         }

    //         // Commit transaksi
    //         DB::commit();

    //         // Redirect ke index dengan pesan sukses
    //         return redirect()->route('CabutBuluPenyebaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // Redirect ke index dengan pesan error
    //         return redirect()->route('CabutBuluPenyebaran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }
}
