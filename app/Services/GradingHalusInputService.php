<?php
namespace App\Services;

use App\Models\MasterJenisGradingHalus;
use App\Models\PreCleaningOutput;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class GradingHalusInputService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Check if $dataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        // Loop melalui setiap item dalam dataArray
        foreach ($dataArray as $data) {
            // Validasi untuk setiap item dalam dataArray
            $validator = Validator::make($data, [
                'nomor_grading' => 'required', // Ganti dengan nama field yang sesuai
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
                    GradingHalusInput::create($data);

                    GradingHalusStock::create([
                        'unit'                  => $data['unit'] ?? 'grading halus',
                        'id_box_grading_halus'  => $data['id_box_grading_halus'],
                        'nomor_batch'           => $data['nomor_batch'],
                        'nomor_nota_internal'   => $data['nomor_nota_internal'],
                        'nama_supplier'         => $data['nama_supplier'],
                        'jenis'                 => $data['jenis_raw_material'],
                        'berat_masuk'           => $data['berat_grading'] ?? 0,
                        'pcs_masuk'             => $data['pcs_grading'] ?? 0,
                        'berat_keluar'          => $data['berat_keluars'] ?? 0,
                        'pcs_keluar'            => $data['pcs_keluars'] ?? 0,
                        'sisa_berat'            => $data['berat_grading'] ?? 0,
                        'sisa_pcs'              => $data['pcs_grading'] ?? 0,
                        'modal'                 => $data['modal'],
                        'total_modal'           => $data['total_modal'],
                        'user_created'          => $data['user_created'],
                        'user_update'           => $data['user_updated'] ?? `"There isn't any"`,
                    ]);

                    $itemObject = (object) $data;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = PreGradingHalusAddingStock::where('nomor_grading', $itemObject->nomor_grading)
                        ->where('nomor_batch', $itemObject->nomor_batch)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'berat_adding' => $itemObject->berat_addings ?? 0,
                            'pcs_adding'   => $itemObject->pcs_addings ?? 0,
                            'total_modal'  => $itemObject->total_modals ?? 0,
                            'user_updated' => $itemObject->user_created ?? "There isn't any",
                        ]);
                    }

                    $existingItems = MasterJenisGradingHalus::where('jenis', $itemObject->jenis_grading)
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
                        'redirectTo' => route('GradingHalusInput.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('GradingHalusInput.index')
        ], 201);
    }

    // public function destroy($nomor_bstb): RedirectResponse
    // {
    //     try {
    //         // Gunakan transaksi database untuk memastikan konsistensi
    //         DB::beginTransaction();

    //         // Ambil data PreCleaningInput berdasarkan nomor_bstb
    //         $GradingHalusInputs = GradingHalusInput::where('nomor_bstb', '=', $nomor_bstb)->get();
    //         // $GradingHalusInputs = GradingHalusInput::findOrFail($id);

    //         if ($GradingHalusInputs->isEmpty()) {
    //             // Redirect ke index dengan pesan error jika data tidak ditemukan
    //             return redirect()->route('GradingHalusInput.index')->with(['error' => 'Data tidak ditemukan!']);
    //         }

    //         foreach ($GradingHalusInputs as $PreCleaningI) {
    //             // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
    //             $PreCleaningS = GradingHalusStock::where('nomor_job', '=', $PreCleaningI->nomor_job)
    //                 ->where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
    //                 ->first();

    //             if ($PreCleaningS) {
    //                 // Ambil data TransitPreCleaningStock berdasarkan nomor job dan nomor bstb
    //                 $stockPrmRawMaterial = TransitPreCleaningStock::where('nomor_job', '=', $PreCleaningI->nomor_job)
    //                     ->where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
    //                     ->first();

    //                 if ($stockPrmRawMaterial) {
    //                     // Simpan nilai sebelum dihapus
    //                     $beratSebelumnya = $stockPrmRawMaterial->berat_kirim;
    //                     $pcsSebelumnya = $stockPrmRawMaterial->pcs_kirim;

    //                     // Hitung total modal baru berdasarkan perbedaan berats
    //                     $perbedaanBerat = $beratSebelumnya + $PreCleaningI->berat_kirim;
    //                     $perbedaanPcs = $pcsSebelumnya + $PreCleaningI->pcs_kirim;
    //                     $totalModalBaru = $perbedaanBerat * $PreCleaningI->modal;

    //                     // Update data TransitPreCleaningStock dengan berat, pcs, dan total modal yang baru
    //                     $stockPrmRawMaterial->update([
    //                         'berat_kirim' => max($perbedaanBerat, 0),
    //                         'pcs_kirim' => max($perbedaanPcs, 0),
    //                         'total_modal' => max($totalModalBaru, 0),
    //                     ]);
    //                 }
    //             }

    //             // Simpan data sebelum dihapus
    //             $beratSebelumHapus = $PreCleaningI->berat_kirim;
    //             $pcsSebelumHapus = $PreCleaningI->pcs_kirim;
    //             $totalModalSebelumHapus = $PreCleaningI->total_modal;

    //             // Hapus data GradingHalusInput dan PreCleaningStock
    //             $PreCleaningI->delete();
    //             if ($PreCleaningS) {
    //                 $PreCleaningS->delete();
    //             }

    //             // Kembalikan nilai sebelum dihapus
    //             if ($stockPrmRawMaterial) {
    //                 $stockPrmRawMaterial->update([
    //                     'berat_keluar' => $stockPrmRawMaterial->berat_keluar + $beratSebelumHapus,
    //                     'pcs_keluar' => $stockPrmRawMaterial->pcs_keluar + $pcsSebelumHapus,
    //                     'total_modal' => $stockPrmRawMaterial->total_modal + $totalModalSebelumHapus,
    //                 ]);
    //             }

    //             // Perbarui status PreCleaningOutput jika ada
    //             $existingItems = PreCleaningOutput::where('nama_supplier', $PreCleaningI->nama_supplier)
    //                 ->where('nomor_bstb', $PreCleaningI->nomor_bstb)
    //                 ->get();

    //             // Logika Update Status
    //             if ($existingItems->isNotEmpty()) {
    //                 foreach ($existingItems as $existingItem) {
    //                     // Perbarui data untuk setiap item yang ada
    //                     $existingItem->update(['status' => 1]);
    //                 }
    //             } else {
    //                 // Jika tidak ada item PreCleaningOutput yang sesuai, buat baru dengan status 1
    //                 PreCleaningOutput::create([
    //                     'nomor_bstb' => $PreCleaningI->nomor_bstb,
    //                     'status' => 1,
    //                     // Tambahkan kolom-kolom lain sesuai kebutuhan
    //                 ]);
    //             }
    //         }

    //         // Commit transaksi
    //         DB::commit();

    //         // Redirect ke index dengan pesan sukses
    //         return redirect()->route('GradingHalusInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // Redirect ke index dengan pesan error
    //         return redirect()->route('GradingHalusInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }
}
