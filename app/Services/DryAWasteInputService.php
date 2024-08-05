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
use App\Models\DryAWasteInput;
use App\Models\DryAWasteStock;
use Illuminate\Support\Facades\Auth;

class DryAWasteInputService
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
                    DryAWasteInput::create($mergedData);

                    $DryAWasteInput = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $DryAWasteStock = DryAWasteStock::where(['jenis_waste' => $DryAWasteInput->jenis_waste,'plant' => $DryAWasteInput->plant])
                        ->get();

                    $found = false;

                    foreach ($DryAWasteStock as $item) {
                        $found = true;

                        // Hitung sisa berat dan sisa pcs
                        $beratMasuk = $item->berat_masuk + ($DryAWasteInput->berat ?? 0);
                        $pcsMasuk = $item->pcs_masuk + ($DryAWasteInput->pcs ?? 0);
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
                            'user_updated' => $DryAWasteInput->user_created ?? "There isn't any",
                        ]);
                    }

                    if (!$found) {
                        DryAWasteStock::create([
                            'unit'              => $mergedData['unit'] ?? 'Dry A',
                            'jenis_waste'       => $mergedData['jenis_waste'],
                            'berat_masuk'       => $mergedData['berat'],
                            'berat_keluar'      => $mergedData['berat_keluar'] ?? 0,
                            'sisa_berat'        => $mergedData['berat'] ?? 0,
                            'pcs_masuk'         => $mergedData['pcs'],
                            'pcs_keluar'        => $mergedData['pcs_keluar'] ?? 0,
                            'sisa_pcs'          => $mergedData['pcs'] ?? 0,
                            'modal'             => $mergedData['modal'] ?? 0,
                            'total_modal'       => $mergedData['total_modal'] ?? 0,
                            'plant' => Auth::user()->plant,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('DryAWasteInput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAWasteInput.index')
        ], 201);
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data item berdasarkan id
            $DryAWasteInput = DryAWasteInput::find($id);

            if (!$DryAWasteInput) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('DryAWasteInput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            // Ambil data DryAWasteStock berdasarkan jenis_waste dan tanggal pembuatan yang sesuai
            $DryAWasteStock = DryAWasteStock::where(['jenis_waste' => $DryAWasteInput->jenis_waste,'plant' => $DryAWasteInput->plant])
                ->where('created_at', '<=', $DryAWasteInput->created_at)
                ->first();

            if ($DryAWasteStock) {
                // Simpan nilai sebelum dihapus
                $beratSebelumnya = $DryAWasteStock->berat_masuk;
                $pcsSebelumnya = $DryAWasteStock->pcs_masuk;

                // Hitung perbedaan berat dan pcs
                $beratBaru = $beratSebelumnya - $DryAWasteInput->berat;
                $pcsBaru = $pcsSebelumnya - $DryAWasteInput->pcs;
                $sisaBeratBaru = $DryAWasteStock->sisa_berat - $DryAWasteInput->berat;
                $sisaPcsBaru = $DryAWasteStock->sisa_pcs - $DryAWasteInput->pcs;
                $totalModal = $DryAWasteStock->modal * $sisaBeratBaru;

                if ($sisaBeratBaru <= 0 && $sisaPcsBaru <= 0) {
                    // Hapus data DryAWasteStock jika sisa_berat dan sisa_pcs baru <= 0
                    $DryAWasteStock->delete();
                } else {
                    // Update data DryAWasteStock dengan berat, pcs, dan sisa yang baru
                    $DryAWasteStock->update([
                        'berat_masuk'   => $beratBaru,
                        'pcs_masuk'     => $pcsBaru,
                        'sisa_berat'    => $sisaBeratBaru,
                        'sisa_pcs'      => $sisaPcsBaru,
                        'total_modal'   => $totalModal,
                    ]);
                }
            }

            // Hapus data DryAWasteInput
            $DryAWasteInput->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAWasteInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAWasteInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
