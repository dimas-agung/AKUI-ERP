<?php

namespace App\Services;

use App\Models\MasterJenisGradingHalus;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;
use App\Models\GradingHalusAdjustmentInput;
use App\Models\GradingHalusStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class GradingHalusAdjustmentInputService
{
    protected $HppService;

    public function __construct(HppService $HppService)
    {
        $this->HppService = $HppService;
    }
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);
        // $susutDepan = json_decode($request->input('susutDepan'), true);
        // $susutBelakang = json_decode($request->input('susutBelakang'), true);
        $tableDataArray = json_decode($request->input('tableDataArray'), true);

        $dataColl = collect($dataArray);
        $berat_gradings = array();
        $harga_estimasi = array();
        $totalModal = array();

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray) || empty($tableDataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau kontribusi kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        foreach ($dataColl as $key => $value) {
            $berat_gradings[] = $value['berat_adjustment']; // Mengubah akses menjadi array asosiatif
            $harga_estimasi[] = $value['harga_estimasi']; // Mengubah akses menjadi array asosiatif
            $totalModal[] = $value['total_modal']; // Mengubah akses menjadi array asosiatif
            $jenisGradings[] = $value['jenis_adjustment']; // Mengubah akses menjadi array asosiatif
        };
        // Calculate HPP values using HppService
        $dataHpp = $this->HppService->calculate($berat_gradings, $harga_estimasi, $totalModal, $jenisGradings);
        // return $berat_gradings;
        // Loop through each item in dataArray
        foreach ($dataArray as $key => $data) {
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data, $tableDataArray[$key]);

            // Update data with HPP values
            $mergedData['total_harga'] = $dataHpp[$key]['total_harga'];
            $mergedData['nilai_laba_rugi'] = $dataHpp[$key]['nilai_laba_rugi'];
            $mergedData['nilai_prosentase_total_keuntungan'] = $dataHpp[$key]['nilai_prosentase_total_keuntungan'];
            $mergedData['nilai_dikurangi_keuntungan'] = $dataHpp[$key]['nilai_setelah_dikurangi_keuntungan'];
            $mergedData['prosentase_harga_gramasi'] = $dataHpp[$key]['prosentase_harga_gramasi'];
            $mergedData['selisih_laba_rugi_kg'] = $dataHpp[$key]['selisih_laba_rugi_kg'];
            $mergedData['selisih_laba_rugi_per_gram'] = $dataHpp[$key]['selisih_laba_rugi_gram'];
            $mergedData['hpp'] = $dataHpp[$key]['hpp'];
            $mergedData['total_hpp'] = $dataHpp[$key]['total_hpp'];
            $mergedData['fix_hpp'] = $dataHpp[$key]['fix_hpp'];
            $mergedData['fix_total_hpp'] = $dataHpp[$key]['fix_total_hpp'];

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                'nomor_adjustment' => 'required', // Change with appropriate field name
                'berat_adjustment' => 'required', // Change with appropriate field name
                'kontribusi' => 'required', // Change with appropriate field name
                // ... add other validations as needed
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

                    // Create instance of AdjustmentInput
                    GradingHalusAdjustmentInput::create($mergedData);

                    $grading = GradingHalusStock::where('id_box_grading_halus', $mergedData['id_box_grading_halus'])
                        ->first();

                    if ($grading) {
                        // Update existing grading data

                        $hpp = $this->HppService->recalculateHpp($grading->berat_masuk, $grading->modal, $mergedData['fix_total_hpp'], $mergedData['berat_adjustment']);
                        $grading->update([
                            'berat_masuk'       => $grading->berat_masuk + ($mergedData['berat_adjustment'] ?? 0),
                            'pcs_masuk'         => $grading->pcs_masuk + ($mergedData['pcs_adjustment'] ?? 0),
                            'berat_keluar'      => $grading->berat_keluar + ($mergedData['berat_keluars'] ?? 0),
                            'pcs_keluar'        => $grading->pcs_keluar + ($mergedData['pcs_keluars'] ?? 0),
                            'sisa_berat'        => $grading->sisa_berat + ($mergedData['berat_adjustment'] ?? 0),
                            'sisa_pcs'          => $grading->sisa_pcs + ($mergedData['pcs_adjustment'] ?? 0),
                            'modal'             => $hpp,
                            'total_modal'       => $hpp * ($grading->sisa_berat + $mergedData['berat_adjustment']),
                            'user_updated'      => $mergedData['user_updated'] ?? "There isn't any",
                        ]);
                    } else {
                        // Create new grading data
                        GradingHalusStock::create([
                            'unit'                  => $mergedData['unit'] ?? 'Grading Halus',
                            'id_box_grading_halus'  => $mergedData['id_box_grading_halus'],
                            'nomor_batch'           => $mergedData['nomor_batch'],
                            // 'nomor_nota_internal'   => $mergedData['nomor_nota_internal'],
                            // 'nama_supplier'         => $mergedData['nama_supplier'],
                            'jenis'                 => $mergedData['jenis_adjustment'],
                            'berat_masuk'           => $mergedData['berat_adjustment'] ?? 0,
                            'pcs_masuk'             => $mergedData['pcs_adjustment'] ?? 0,
                            'berat_keluar'          => $mergedData['berat_keluars'] ?? 0,
                            'pcs_keluar'            => $mergedData['pcs_keluars'] ?? 0,
                            'sisa_berat'            => $mergedData['berat_adjustment'] ?? 0,
                            'sisa_pcs'              => $mergedData['pcs_adjustment'] ?? 0,
                            'modal'                 => $mergedData['fix_hpp'],
                            'total_modal'           => $mergedData['fix_hpp'] * $mergedData['berat_adjustment'],
                            'user_created'          => $mergedData['user_created'] ?? "There isn't any",
                            'user_updated'          => $mergedData['user_updated'] ?? "There isn't any",
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingHalusAdjustmentInput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('GradingHalusAdjustmentInput.index')
        ], 201);
    }
    // public function destroy($id)
    // {
    //     try {
    //         // Mulai transaksi database
    //         DB::beginTransaction();

    //         // Temukan data GradingHalusAdjustmentInput berdasarkan ID
    //         $gradingHalusAdjustmentInput = GradingHalusAdjustmentInput::find($id);

    //         if (!$gradingHalusAdjustmentInput) {
    //             // Jika data tidak ditemukan, kembalikan pesan error
    //             return [
    //                 'success' => false,
    //                 'error' => 'Data tidak ditemukan.',
    //             ];
    //         }

    //         // Temukan data GradingHalusStock berdasarkan id_box_grading_halus
    //         $gradingHalusStock = GradingHalusStock::where('id_box_grading_halus', $gradingHalusAdjustmentInput->id_box_grading_halus)
    //             ->first();

    //         if ($gradingHalusStock) {
    //             // Kurangi berat_masuk, pcs_masuk, berat_keluar, dan pcs_keluar di GradingHalusStock
    //             $gradingHalusStock->berat_masuk -= $gradingHalusAdjustmentInput->berat_adjustment;
    //             $gradingHalusStock->pcs_masuk -= $gradingHalusAdjustmentInput->pcs_adjustment;
    //             $gradingHalusStock->berat_keluar -= $gradingHalusAdjustmentInput->berat_keluars;
    //             $gradingHalusStock->pcs_keluar -= $gradingHalusAdjustmentInput->pcs_keluars;
    //             $gradingHalusStock->sisa_berat -= $gradingHalusAdjustmentInput->berat_adjustment;
    //             $gradingHalusStock->sisa_pcs -= $gradingHalusAdjustmentInput->pcs_adjustment;
    //             $gradingHalusStock->user_updated = auth()->user()->name;
    //             $gradingHalusStock->save();
    //         }

    //         // Hapus data GradingHalusAdjustmentInput
    //         $gradingHalusAdjustmentInput->delete();

    //         // Commit transaksi
    //         DB::commit();

    //         // Kembalikan respons sukses
    //         return [
    //             'success' => true,
    //             'message' => 'Data berhasil dihapus!',
    //         ];
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // Kembalikan pesan error
    //         return [
    //             'success' => false,
    //             'error' => 'Gagal menghapus data. ' . $e->getMessage(),
    //         ];
    //     }
    // }

    public function hapusData($id)
    {
        try {
            DB::beginTransaction();

            // Dapatkan id_box_grading_halus dan nomor_batch berdasarkan ID
            $data = GradingHalusAdjustmentInput::select('id_box_grading_halus', 'nomor_batch')->find($id);

            if ($data) {
                // Hapus data dari GradingHalusAdjustmentInput berdasarkan id_box_grading_halus dan nomor_batch
                GradingHalusAdjustmentInput::where('id_box_grading_halus', $data->id_box_grading_halus)
                    ->where('nomor_batch', $data->nomor_batch)
                    ->delete();

                // Perbarui data di GradingHalusStock
                $gradingHalusStock = GradingHalusStock::where('id_box_grading_halus', $data->id_box_grading_halus)
                    ->where('nomor_batch', $data->nomor_batch)
                    ->first();

                if ($gradingHalusStock) {
                    $gradingHalusStock->berat_masuk -= $data->berat_adjustment ?? 0;
                    $gradingHalusStock->pcs_masuk -= $data->pcs_adjustment ?? 0;
                    $gradingHalusStock->sisa_berat -= $data->berat_adjustment ?? 0;
                    $gradingHalusStock->sisa_pcs -= $data->pcs_adjustment ?? 0;
                    $gradingHalusStock->save();
                }
            } else {
                // Jika data tidak ditemukan, langsung hapus dari GradingHalusAdjustmentInput
                GradingHalusAdjustmentInput::where('id', $id)->delete();
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil dihapus!',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menghapus data. ' . $e->getMessage(),
            ];
        }
    }
}
