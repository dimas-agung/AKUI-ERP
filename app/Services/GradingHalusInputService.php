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
    protected $HppService;

    public function __construct(HppService $HppService)
    {
        $this->HppService = $HppService;
    }
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);
        $tableDataArray = json_decode($request->input('tableDataArray'), true);

        $dataColl = collect($dataArray);
        $berat_gradings = array();
        $harga_estimasi = array();
        $totalModal = array();

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray) || empty($tableDataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau data susut atau kontribusi kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        foreach ($dataColl as $key => $value) {
            $berat_gradings[] = $value['berat_grading']; // Mengubah akses menjadi array asosiatif
            $harga_estimasi[] = $value['harga_estimasi']; // Mengubah akses menjadi array asosiatif
            $totalModal[] = $value['total_modal']; // Mengubah akses menjadi array asosiatif
            $jenisGradings[] = $value['jenis_grading']; // Mengubah akses menjadi array asosiatif
        };

        // Calculate HPP values using HppService
        $dataHpp = $this->HppService->calculate($berat_gradings, $harga_estimasi, $totalModal, $jenisGradings);

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
                'nomor_grading' => 'required', // Change with appropriate field name
                'berat_grading' => 'required', // Change with appropriate field name
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

                    // Create instance of GradingHalusInput
                    GradingHalusInput::create($mergedData);

                    GradingHalusStock::create([
                        'unit'                  => $mergedData['unit'] ?? 'grading halus',
                        'id_box_grading_halus'  => $mergedData['id_box_grading_halus'],
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'nomor_nota_internal'   => $mergedData['nomor_nota_internal'],
                        'nama_supplier'         => $mergedData['nama_supplier'],
                        'jenis'                 => $mergedData['jenis_raw_material'],
                        'berat_masuk'           => $mergedData['berat_grading'] ?? 0,
                        'pcs_masuk'             => $mergedData['pcs_grading'] ?? 0,
                        'berat_keluar'          => $mergedData['berat_keluars'] ?? 0,
                        'pcs_keluar'            => $mergedData['pcs_keluars'] ?? 0,
                        'sisa_berat'            => $mergedData['berat_grading'] ?? 0,
                        'sisa_pcs'              => $mergedData['pcs_grading'] ?? 0,
                        'modal'                 => $mergedData['modal'],
                        'total_modal'           => $mergedData['total_modal'],
                        'user_created'          => $mergedData['user_created'],
                        'user_update'           => $mergedData['user_updated'] ?? `"There isn't any"`,
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = PreGradingHalusAddingStock::where('nomor_grading', $itemObject->nomor_grading)
                        ->where('nomor_batch', $itemObject->nomor_batch)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'status_stock' => $itemObject->statuss ?? 0,
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
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingHalusInput.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
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

            if ($GradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingHalusInput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($GradingHalusInputs as $PreCleaningI) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = GradingHalusStock::where('id_box_grading_halus', '=', $PreCleaningI->id_box_grading_halus)
                    ->first();

                    if ($PreCleaningS) {
                        // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                        $stockPrmRawMaterial = PreGradingHalusAddingStock::where('nomor_grading', '=', $PreCleaningI->nomor_grading)
                            ->first();

                        if ($stockPrmRawMaterial) {
                            // Simpan nilai sebelum dihapus
                            $beratSebelumnya = $stockPrmRawMaterial->berat_adding;
                            $pcsSebelumnya = $stockPrmRawMaterial->pcs_adding;
                            $totalModalSebelumnya = $stockPrmRawMaterial->total_modal;

                            // Hitung perbedaan berat dan pcs
                            $perbedaanBerat = $PreCleaningI->berat_adding;
                            $perbedaanPcs = $PreCleaningI->pcs_adding;

                            // Hitung total modal baru
                            $totalModalBaru = $perbedaanBerat * $PreCleaningI->modal;

                            // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                            $stockPrmRawMaterial->update([
                                'berat_adding' => max($beratSebelumnya + $perbedaanBerat, 0),
                                'pcs_adding' => max($pcsSebelumnya + $perbedaanPcs, 0),
                                'total_modal' => max($totalModalBaru, 0),
                                'status_stock' => 1,
                            ]);
                        }
                    }

                if ($PreCleaningS) {
                    // Hapus data PreCleaningStock
                    $PreCleaningS->delete();
                }

                // Hapus data GradingHalusInput
                $PreCleaningI->delete();
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
