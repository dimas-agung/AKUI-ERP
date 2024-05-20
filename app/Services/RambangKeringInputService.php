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
                            'sisa_berat'        => 0,
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

    public function destroy($id_box_hcr_kotor)
    {
        try {
            // Begin transaction
            DB::beginTransaction();
            // Temukan record berdasarkan ID
            $PreCleaningOutput = RambangKeringInput::findOrFail($id_box_hcr_kotor);
            // Hapus semua item terkait
            $stockPRM = RambangKeringStock::where('id_box_hcr_kotor', '=', $PreCleaningOutput->id_box_hcr_kotor)
                // ->where('jenis_rambang', $PreCleaningOutput->jenis_rambang)
                ->first();

            if ($stockPRM) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                if ($stockPRM->berat_keluar === 0) {
                    $stockPRM->delete();
                } else {
                    // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                    if ($PreCleaningOutput->berat_kering >= $stockPRM->berat_keluar) {
                        $stockPRM->delete();
                    } else {
                    }
                }
            }

            $existingItems = RambangBasahStock::where('id_box_hcr_kotor', $PreCleaningOutput->id_box_hcr_kotor)
                ->where('jenis_rambang', $PreCleaningOutput->jenis_rambang)
                ->get();

            // Logika Update Status
            foreach ($existingItems as $existingItem) {

                // Perbarui data untuk setiap item yang ada
                if ($existingItem) {
                    $beratSebelumnya = $existingItem->berat_keluar;
                    // $sisaBerat = $existingItem->berat_keluar - $PreCleaningOutput->berat_kirim;

                    // Hitung total modal baru berdasarkan perbedaan berat
                    $perbedaanBerat = $beratSebelumnya - $PreCleaningOutput->berat_basah;
                    $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;

                    $existingItem->update(['berat_keluar'   => $perbedaanBerat]);
                    $existingItem->update(['sisa_berat'     => $sisaBerat]);
                }

                // Hapus record utama
                $PreCleaningOutput->delete();

                // Jika tidak ada kesalahan, komit transaksi
                DB::commit();

                return redirect()->route('RambangKeringInput.index')->with('success', 'Data berhasil dihapus');
            }
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('RambangKeringInput.index')->with('error', 'Gagal menghapus data');
        }
    }

    // public function destroy($id_box_hcr_kotor)
    // {
    //     try {
    //         // Mulai transaksi
    //         DB::beginTransaction();

    //         // Temukan record berdasarkan ID
    //         $PreCleaningOutput = RambangKeringInput::findOrFail($id_box_hcr_kotor);

    //         // Hapus semua item terkait di tabel RambangKeringStock
    //         $stockPRM = RambangKeringStock::where('id_box_hcr_kotor', $PreCleaningOutput->id_box_hcr_kotor)
    //             ->where('jenis_rambang', $PreCleaningOutput->jenis_rambang)
    //             ->first();

    //         if ($stockPRM) {
    //             if ($stockPRM->berat_keluar === 0 || $PreCleaningOutput->berat_kering >= $stockPRM->berat_keluar) {
    //                 $stockPRM->delete();
    //             }
    //         }

    //         // Ambil dan perbarui data terkait di tabel RambangBasahStock
    //         $existingItems = RambangBasahStock::where('id_box_hcr_kotor', $PreCleaningOutput->id_box_hcr_kotor)
    //             ->where('jenis_rambang', $PreCleaningOutput->jenis_rambang)
    //             ->get();

    //         foreach ($existingItems as $existingItem) {
    //             if ($existingItem) {
    //                 $beratSebelumnya = $existingItem->berat_keluar;
    //                 $perbedaanBerat = $beratSebelumnya - $PreCleaningOutput->berat_basah;
    //                 $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;

    //                 $existingItem->update(['berat_keluar' => $perbedaanBerat, 'sisa_berat' => $sisaBerat]);
    //             }
    //         }

    //         // Hapus record utama
    //         $PreCleaningOutput->delete();

    //         // Komit transaksi jika tidak ada kesalahan
    //         DB::commit();

    //         return redirect()->route('RambangKeringInput.index')->with('success', 'Data berhasil dihapus');
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         return redirect()->route('RambangKeringInput.index')->with('error', 'Gagal menghapus data');
    //     }
    // }
}
