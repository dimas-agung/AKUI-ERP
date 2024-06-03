<?php

namespace App\Services;

use App\Models\DryAGradingCabut;
use App\Models\DryAGradingCabutStock;
use App\Models\DryAPenerimaanCabut;
use App\Models\DryAPenerimaanCabutStock;
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

class DryAGradingCabutService
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
                // 'nomor_grading' => 'required', // Change with appropriate field name
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
                    // GradingHalusInput::create($mergedData);
                    DryAGradingCabut::create($mergedData);

                    DryAGradingCabutStock::create([
                        'unit'                  => $mergedData['unit'] ?? 'Dry A',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'],
                        'berat_kotor'           => $mergedData['berat_kotor'],
                        'jenis_grading'         => $mergedData['jenis_grading'],
                        'berat_1_grading'       => $mergedData['berat_1_grading'],
                        'pcs_1_grading'         => $mergedData['pcs_1_grading'],
                        'berat_2_grading'       => $mergedData['berat_2_grading'],
                        'modal'                 => $mergedData['fix_hpp'],
                        'total_modal'           => $mergedData['fix_total_hpp'],

                    ]);

                    // $grading = GradingHalusStock::where('id_box_grading_halus', $mergedData['id_box_grading_halus'])
                    //     ->first();
                    // $grading = DryAGradingCabutStock::where('nomor_job', $mergedData['nomor_job'])
                    //     ->first();

                    // if ($grading) {
                    //     // $total_berat = $grading->berat_masuk + ($mergedData['berat_grading'] ?? 0);
                    //     $hpp = $this->HppService->recalculateHpp($grading->berat_grading, $grading->modal, $mergedData['fix_total_hpp'], $mergedData['berat_grading']);

                    //     // Update existing grading data
                    //     $grading->update([
                    //         'berat_1_grading'       => $grading->berat_grading + ($mergedData['berat_grading'] ?? 0),
                    //         'pcs_1_grading'         => $grading->pcs_1_grading + ($mergedData['pcs_grading'] ?? 0),
                    //         'berat_keluar'          => $grading->berat_keluar + ($mergedData['berat_keluars'] ?? 0),
                    //         'pcs_keluar'            => $grading->pcs_keluar + ($mergedData['pcs_keluars'] ?? 0),
                    //         'sisa_berat'            => $grading->sisa_berat + ($mergedData['berat_grading'] ?? 0),
                    //         'sisa_pcs'              => $grading->sisa_pcs + ($mergedData['pcs_grading'] ?? 0),
                    //         'modal'                 => $hpp,
                    //         'total_modal'           => $hpp * ($grading->sisa_berat + $mergedData['berat_grading']),
                    //         'user_update'           => $mergedData['user_updated'] ?? "There isn't any",
                    //     ]);
                    // } else {
                    // Create new grading data
                    // GradingHalusStock::create([
                    // DryAGradingCabutStock::create([
                    //     'unit'                  => $mergedData['unit'] ?? 'Dry A',
                    //     'nomor_job'             => $mergedData['nomor_job'],
                    //     'nomor_batch'           => $mergedData['nomor_batch'],
                    //     'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                    //     'keterangan'            => $mergedData['keterangan'],
                    //     'berat_kotor'           => $mergedData['berat_kotor'],
                    //     'jenis_grading'         => $mergedData['jenis_grading'],
                    //     'berat_1_grading'       => $mergedData['berat_1_grading'],
                    //     'pcs_1_grading'         => $mergedData['pcs_1_grading'],
                    //     'berat_2_grading'       => $mergedData['berat_2_grading'],
                    //     'modal'                 => $mergedData['fix_hpp'],
                    //     'total_modal'           => $mergedData['fix_total_hpp'],

                    // ]);
                    // }

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    // $existingItems = PreGradingHalusAddingStock::where('nomor_grading', $itemObject->nomor_grading)
                    //     ->where('nomor_batch', $itemObject->nomor_batch)
                    //     ->get();
                    $existingItems = DryAPenerimaanCabutStock::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            // Update data PreGradingHalusAddingStock
                            'status'         => $itemObject->status ?? 0,
                        ]);
                    }

                    // $existingItems = MasterJenisGradingHalus::where('jenis', $itemObject->jenis_grading)
                    //     ->get();

                    // $dataToUpdate = [
                    //     'status'                => $itemObject->status ?? 0,
                    // ];

                    // if ($existingItems) {
                    //     foreach ($existingItems as $existingItem) {
                    //         $existingItem->update($dataToUpdate);
                    //     }
                    // }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('DryAGradingCabut.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAGradingCabut.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            // Temukan semua record berdasarkan nomor_job
            $DryAGradingCabut = DryAGradingCabut::where('nomor_job', $nomor_job)->get();

            if ($DryAGradingCabut->isEmpty()) {
                throw new \Exception('Data tidak ditemukan');
            }

            foreach ($DryAGradingCabut as $DryAGradingCabutInput) {
                // Hapus semua item terkait di TransitRambangWaste
                $stockTrans = DryAGradingCabutStock::where('nomor_job', '=', $DryAGradingCabutInput->nomor_job)->first();

                if ($stockTrans) {
                    // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                    if ($stockTrans->status === 1) {
                        $stockTrans->delete();
                    } else {
                        // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                        if ($DryAGradingCabutInput->berat_kotor >= $stockTrans->berat_kotor) {
                            $stockTrans->delete();
                        } else {
                            // Jika berat yang dimasukkan kurang dari berat stock, lakukan update sesuai kebutuhan
                            // $stockTrans->berat -= $DryAGradingCabutInput->berat;
                            // $stockTrans->save();
                        }
                    }
                }

                // Temukan semua item terkait di RambangKeringStock
                $existingItems = DryAPenerimaanCabutStock::where('nomor_job', $DryAGradingCabutInput->nomor_job)
                    ->where('jenis_job', $DryAGradingCabutInput->jenis_job)
                    ->get();

                // Logika Update Status
                foreach ($existingItems as $existingItem) {
                    if ($existingItem) {
                        // $beratSebelumnya = $existingItem->berat_keluar;

                        // // Hitung total modal baru berdasarkan perbedaan berat
                        // $perbedaanBerat = $beratSebelumnya - $DryAGradingCabutInput->berat;
                        // $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;

                        // $existingItem->update(['berat_keluar' => $perbedaanBerat]);
                        // $existingItem->update(['sisa_berat' => $sisaBerat]);
                        $existingItem->update(['status' => 1]);
                    }
                }

                // Temukan semua item terkait di RambangKeringStock
                $RambangKeringInput = DryAPenerimaanCabut::where('nomor_job', $DryAGradingCabutInput->nomor_job)
                    ->where('jenis_job', $DryAGradingCabutInput->jenis_job)
                    ->get();
                foreach ($RambangKeringInput as $item) {
                    if ($item) {
                        $item->update(['status' => 1]);
                    }
                }


                // Hapus record utama
                $DryAGradingCabutInput->delete();
            }

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('DryAGradingCabut.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('DryAGradingCabut.index')->with('error', 'Gagal menghapus data');
        }
    }
}
