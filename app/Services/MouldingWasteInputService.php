<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\MouldingWasteInput;
use App\Models\MouldingWasteStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class MouldingWasteInputService
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
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data);

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                // 'created_at' => 'required', // Change with appropriate field name
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
                    MouldingWasteInput::create($mergedData);

                    $MouldingWasteInput = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $MouldingWasteStock = MouldingWasteStock::where('id_box_waste_moulding', '=', $MouldingWasteInput->id_box_waste_moulding)
                        ->where('jenis_waste', '=', $MouldingWasteInput->jenis_waste)
                        ->get();

                    $found = false;

                    foreach ($MouldingWasteStock as $item) {
                        $found = true;

                        // Hitung sisa berat dan sisa pcs
                        $beratMasuk = $item->berat_masuk + ($MouldingWasteInput->berat ?? 0);
                        $pcsMasuk = $item->pcs_masuk + ($MouldingWasteInput->pcs ?? 0);
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
                            'user_updated' => $MouldingWasteInput->user_created ?? "There isn't any",
                        ]);
                    }

                    if (!$found) {
                        MouldingWasteStock::create([
                            'plant'                     => $mergedData['plant'],
                            'unit'                      => $mergedData['unit'] ?? 'Moulding',
                            'jenis_waste'               => $mergedData['jenis_waste'],
                            'id_box_waste_moulding'     => $mergedData['id_box_waste_moulding'],
                            'berat_masuk'               => $mergedData['berat'],
                            'berat_keluar'              => $mergedData['berat_keluar'] ?? 0,
                            'sisa_berat'                => $mergedData['berat'] ?? 0,
                            'pcs_masuk'                 => $mergedData['pcs'],
                            'pcs_keluar'                => $mergedData['pcs_keluar'] ?? 0,
                            'sisa_pcs'                  => $mergedData['pcs'] ?? 0,
                            'modal'                     => $mergedData['modal'] ?? 0,
                            'total_modal'               => $mergedData['total_modal'] ?? 0,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('MouldingWasteInput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('MouldingWasteInput.index')
        ], 201);
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data item berdasarkan id
            $MouldingWasteInput = MouldingWasteInput::find($id);

            if (!$MouldingWasteInput) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('MouldingWasteInput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            // Ambil data MouldingWasteStock berdasarkan id_box_waste_moulding dan tanggal pembuatan yang sesuai
            $MouldingWasteStock = MouldingWasteStock::where('id_box_waste_moulding', '=', $MouldingWasteInput->id_box_waste_moulding)
                ->where('jenis_waste', '=', $MouldingWasteInput->jenis_waste)
                ->where('created_at', '<=', $MouldingWasteInput->created_at)
                ->first();

            if ($MouldingWasteStock) {
                // Simpan nilai sebelum dihapus
                $beratSebelumnya = $MouldingWasteStock->berat_masuk;
                $pcsSebelumnya = $MouldingWasteStock->pcs_masuk;

                // Hitung perbedaan berat dan pcs
                $beratBaru = $beratSebelumnya - $MouldingWasteInput->berat;
                $pcsBaru = $pcsSebelumnya - $MouldingWasteInput->pcs;
                $sisaBeratBaru = $MouldingWasteStock->sisa_berat - $MouldingWasteInput->berat;
                $sisaPcsBaru = $MouldingWasteStock->sisa_pcs - $MouldingWasteInput->pcs;
                $totalModal = $MouldingWasteStock->modal * $sisaBeratBaru;

                if ($sisaBeratBaru <= 0 && $sisaPcsBaru <= 0) {
                    // Hapus data MouldingWasteStock jika sisa_berat dan sisa_pcs baru <= 0
                    $MouldingWasteStock->delete();
                } else {
                    // Update data MouldingWasteStock dengan berat, pcs, dan sisa yang baru
                    $MouldingWasteStock->update([
                        'berat_masuk'   => $beratBaru,
                        'pcs_masuk'     => $pcsBaru,
                        'sisa_berat'    => $sisaBeratBaru,
                        'sisa_pcs'      => $sisaPcsBaru,
                        'total_modal'   => $totalModal,
                    ]);
                }
            }

            // Hapus data MouldingWasteInput
            $MouldingWasteInput->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('MouldingWasteInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('MouldingWasteInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
