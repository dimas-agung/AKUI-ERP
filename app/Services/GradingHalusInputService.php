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

    public function destroy($nomor_grading): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_grading
            $GradingHalusInputs = GradingHalusInput::where('nomor_grading', '=', $nomor_grading)->get();
            // $GradingHalusInputs = GradingHalusInput::findOrFail($id);

            if ($GradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingHalusInput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($GradingHalusInputs as $PreCleaningI) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = GradingHalusStock::where('id_box_grading_halus', '=', $PreCleaningI->id_box_grading_halus)
                    ->where('nomor_grading', '=', $PreCleaningI->nomor_grading)
                    ->first();

                if ($PreCleaningS) {
                    // Ambil data PreGradingHalusAddingStock berdasarkan nomor job dan nomor bstb
                    $stockPrmRawMaterial = PreGradingHalusAddingStock::where('nomor_grading', '=', $PreCleaningI->nomor_grading)
                        ->first();

                    if ($stockPrmRawMaterial) {
                        // Simpan nilai sebelum dihapus
                        $beratSebelumnya = $stockPrmRawMaterial->berat_adding;
                        $pcsSebelumnya = $stockPrmRawMaterial->pcs_adding;

                        // Hitung total modal baru berdasarkan perbedaan berats
                        $perbedaanBerat = $beratSebelumnya + $PreCleaningI->berat_adding;
                        $perbedaanPcs = $pcsSebelumnya + $PreCleaningI->pcs_adding;
                        $totalModalBaru = $perbedaanBerat * $PreCleaningI->modal;

                        // Update data PreGradingHalusAddingStock dengan berat, pcs, dan total modal yang baru
                        $stockPrmRawMaterial->update([
                            'berat_adding' => max($perbedaanBerat, 0),
                            'pcs_adding' => max($perbedaanPcs, 0),
                            'total_modal' => max($totalModalBaru, 0),
                        ]);
                    }
                }

                // Simpan data sebelum dihapus
                $beratSebelumHapus = $PreCleaningI->berat_adding;
                $pcsSebelumHapus = $PreCleaningI->pcs_adding;
                $totalModalSebelumHapus = $PreCleaningI->total_modal;

                // Hapus data GradingHalusInput dan PreCleaningStock
                $PreCleaningI->delete();
                if ($PreCleaningS) {
                    $PreCleaningS->delete();
                }

                // Kembalikan nilai sebelum dihapus
                if ($stockPrmRawMaterial) {
                    $stockPrmRawMaterial->update([
                        'berat_adding' => $stockPrmRawMaterial->berat_adding + $beratSebelumHapus,
                        'pcs_adding' => $stockPrmRawMaterial->pcs_adding + $pcsSebelumHapus,
                        'total_modal' => $stockPrmRawMaterial->total_modal + $totalModalSebelumHapus,
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('GradingHalusInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('GradingHalusInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
