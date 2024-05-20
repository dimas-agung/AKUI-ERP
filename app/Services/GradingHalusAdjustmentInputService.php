<?php

namespace App\Services;

use App\Models\MasterJenisGradingHalus;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;
use App\Models\GradingHalusAdjustmentInput;
use App\Models\GradingHalusAdjustmentStock;
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

                    $GradingHalusAdjustmentStock = GradingHalusAdjustmentStock::where('nomor_adjustment', $mergedData['nomor_adjustment'])
                        ->first();

                    if ($GradingHalusAdjustmentStock) {
                        $GradingHalusAdjustmentStock->update([
                            'user_updated' => $mergedData['user_created'] ?? "There isn't any",
                            'status'       => 0,
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

    public function destroy($id)
    {
        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Temukan record berdasarkan id
            $GradingHalusAdjustmentInput = GradingHalusAdjustmentInput::findOrFail($id);
            $nomorAdjustment = $GradingHalusAdjustmentInput->nomor_adjustment;

            // Temukan semua item dengan nomor_adjustment yang sama
            $findNomorAdjustment = GradingHalusAdjustmentInput::where('nomor_adjustment', $nomorAdjustment)->get();

            foreach ($findNomorAdjustment as $item) {
                // Temukan stok terkait
                $gradingHalusStock = GradingHalusStock::where('id_box_grading_halus', $item->id_box_grading_halus)
                    ->first();

                if ($gradingHalusStock) {
                    $beratSebelumnya = $gradingHalusStock->berat_masuk;
                    $pcsSebelumnya = $gradingHalusStock->pcs_masuk;

                    $perbedaanBerat = $beratSebelumnya - $item->berat_adjustment;
                    $perbedaanPcs = $pcsSebelumnya - $item->pcs_adjustment;
                    $sisaBerat = $perbedaanBerat - $gradingHalusStock->berat_keluar;
                    $sisaPcs = $perbedaanPcs - $gradingHalusStock->pcs_keluar;

                    if ($sisaBerat <= 0) {
                        $gradingHalusStock->delete();
                    } else {
                        $totalModalBaru = $sisaBerat * $gradingHalusStock->modal;

                        $gradingHalusStock->update([
                            'berat_masuk' => $perbedaanBerat,
                            'sisa_berat' => $sisaBerat,
                            'pcs_masuk' => $perbedaanPcs,
                            'sisa_pcs' => $sisaPcs,
                            'total_modal' => $totalModalBaru,
                            'status' => 1,
                        ]);
                    }
                }

                // Hapus item terkait
                $item->delete();
            }

            $existingItems = GradingHalusAdjustmentStock::where('nomor_adjustment', $GradingHalusAdjustmentInput->nomor_adjustment)
                ->where('nomor_batch', $GradingHalusAdjustmentInput->nomor_batch)
                ->get();

            // Logika Update Status
            foreach ($existingItems as $existingItem) {
                if ($existingItem) {

                    $existingItem->update([
                        'status' => 1,
                    ]);
                }
            }

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return ['success' => true];
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
