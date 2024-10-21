<?php
namespace App\Services;

use App\Models\PreCleaningOutput;
use Illuminate\Http\Request;
use App\Models\PreGradingHalusInput;
use App\Models\PreGradingHalusStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class PreGradingHalusInputService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'user_created' => 'required',
            'user_updated' => 'required',
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
                'unit' => 'required', // Ganti dengan nama field yang sesuai
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
                    PreGradingHalusInput::create($mergedData);

                    PreGradingHalusStock::create([
                        'unit'             => $mergedData['unit'] ?? 'grading halus',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'id_box_grading_kasar'  => $mergedData['id_box_grading_kasar'],
                        'nomor_bstb'    => $mergedData['nomor_bstb'],
                        'nomor_batch'   => $mergedData['nomor_batch'],
                        'nama_supplier' => $mergedData['nama_supplier'],
                        'id_box_raw_material'        => $mergedData['id_box_raw_material'],
                        'jenis_raw_material'         => $mergedData['jenis_raw_material'],
                        'kadar_air'     => $mergedData['kadar_air'],
                        'tujuan_kirim'      => $mergedData['tujuan_kirim'],
                        'jenis_kirim'       => $mergedData['jenis_kirim'],
                        'berat_kirim'      => $mergedData['berat_kirim'] ?? 0,
                        'pcs_kirim'        => $mergedData['pcs_kirim'] ?? 0,
                        'jenis_pre_cleaning'       => $mergedData['jenis_pre_cleaning'],
                        'berat_pre_cleaning'       => $mergedData['berat_pre_cleaning'] ?? 0,
                        'pcs_pre_cleaning'         => $mergedData['pcs_pre_cleaning'] ?? 0,
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                        'user_created'  => $mergedData['user_created'],
                        'user_update'   => $mergedData['user_updated'] ?? `" "`,
                        'nomor_nota_internal'   => $mergedData['nomor_nota_internal']
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = TransitPreCleaningStock::where('nomor_job', $itemObject->nomor_job)
                        ->where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data TransitPreCleaningStock
                            'status' => 0,
                        ]);
                    }

                    $existingItems = PreCleaningOutput::where('nama_supplier', $itemObject->nama_supplier)
                    ->where('nomor_bstb', $itemObject->nomor_bstb)
                    ->get();

                    $dataToUpdate = [
                        'status'                => $itemObject->status ?? 0,
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
                        'redirectTo' => route('PreGradingHalusInput.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('PreGradingHalusInput.index')
        ], 201);
    }

    public function destroy($nomor_bstb): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_bstb
            $PreGradingHalusInputs = PreGradingHalusInput::where('nomor_bstb', '=', $nomor_bstb)->delete();
            // $PreGradingHalusInputs = PreGradingHalusInput::findOrFail($id);

            $PreGradingHalusStock = PreGradingHalusStock::where('nomor_bstb', '=', $nomor_bstb)
            ->delete();
            $TransitPreCleaningStock = TransitPreCleaningStock::where('nomor_bstb', '=', $nomor_bstb)
                ->update(['status' => 1]);
            $existingItems = PreCleaningOutput::where('nomor_bstb', $nomor_bstb)
                ->update(['status' => 1]);


            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('PreGradingHalusInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('PreGradingHalusInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
