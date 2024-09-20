<?php
namespace App\Services;

use App\Models\CabutBuluPengembalian;
use App\Models\DryAPenerimaanCabut;
use App\Models\DryAPenerimaanCabutStock;
use App\Models\MasterJenisGradingHalus;
use App\Models\PreGradingHalusAddingStock;
use App\Models\TransitCabutBulu;
use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class DryAPenerimaanService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array atau data susut atau kontribusi kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }


        // Loop through each item in dataArray
        foreach ($dataArray as $key => $data) {
            // Merge data from $dataArray and $tableDataArray
            $mergedData = array_merge($data);

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                'nomor_job' => 'required', // Change with appropriate field name
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
                    DryAPenerimaanCabut::create($mergedData);

                    $grading = DryAPenerimaanCabutStock::where('nomor_job', $mergedData['nomor_job'])
                        ->first();

                    if ($grading) {

                        // Update existing grading data
                        $grading->update([
                            'berat_job'       => $grading->berat_job + ($mergedData['berat_job'] ?? 0),
                            'pcs_job'         => $grading->pcs_job + ($mergedData['pcs_job'] ?? 0),
                        ]);
                    } else {
                        // Create new grading data
                        DryAPenerimaanCabutStock::create([
                            'unit'                  => $mergedData['unit'] ?? 'Dry A',
                            'nomor_job'             => $mergedData['nomor_job'],
                            'nomor_batch'           => $mergedData['nomor_batch'],
                            'jenis_job'             => $mergedData['jenis_job'],
                            'berat_job'             => $mergedData['berat_job'],
                            'pcs_job'               => $mergedData['pcs_job'],
                            'nama_operator'         => $mergedData['nama_operator'] ?? 0,
                            'nip_operator'          => $mergedData['nip_operator'] ?? 0,
                            'grade_operator'        => $mergedData['grade_operator'] ?? 0,
                            'nama_team_leader'      => $mergedData['nama_team_leader'] ?? 0,
                            'tujuan_kirim'          => $mergedData['tujuan_kirim'] ?? 0,
                            'keterangan'            => $mergedData['keterangan'] ?? 0,
                            'modal'                 => $mergedData['modal'],
                            'total_modal'           => $mergedData['total_modal'],
                            'upah_operator'         => $mergedData['upah_operator']
                        ]);
                    }

                    $itemObject = (object) $mergedData;
                    $dataUpdate = [
                        'status' => 0
                    ];
                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = TransitCabutBulu::where('nomor_job', $itemObject->nomor_job)
                        ->where('jenis_job', $itemObject->jenis_job)
                        ->update($dataUpdate);

                    
                    $existingItems = CabutBuluPengembalian::where('nomor_job', $itemObject->nomor_job)
                    ->update($dataUpdate);


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('DryAPenerimaan.create')
                    ], 504);
                }
            }
        }

        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('DryAPenerimaan.index')
        ], 201);
    }

    public function destroy($nomor_job): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data DryAPenerimaanCabutnput berdasarkan nomor_job
            $DryAPenerimaanCabuts = DryAPenerimaanCabut::where('nomor_job', '=', $nomor_job)->get();

            if ($DryAPenerimaanCabuts->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('DryAPenerimaan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($DryAPenerimaanCabuts as $DryAPenerimaanCabut) {
                // Ambil data DryAPenerimaanCabutStocktock berdasarkan nomor job dan nomor bstb
                $DryAPenerimaanCabutStock = DryAPenerimaanCabutStock::where('nomor_job', '=', $DryAPenerimaanCabut->$nomor_job)
                    ->first();
                    
                    if ($DryAPenerimaanCabutStock) {
                        // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                        
                    }
                    $TransitCabutBulu = TransitCabutBulu::where('nomor_job', '=', $DryAPenerimaanCabut->nomor_job)
                        ->update([
                            // 'berat_job' => max($DryAPenerimaanCabut->berat_job, 0),
                            // 'pcs_job' => max($DryAPenerimaanCabut->pcs_job, 0),
                            'status' => 1,
                        ]);

                    $dataToUpdate = [
                        'status'                =>3,
                    ];
                    $existingItems = CabutBuluPengembalian::where('nomor_job', $DryAPenerimaanCabut->nomor_job)
                    ->update($dataToUpdate);

                    // if ($DryAPenerimaanCabut->berat_grading >= $DryAPenerimaanCabutStock->berat_masuk) {
                    //     $DryAPenerimaanCabutStock->delete();
                    // } else {
                    //     // Simpan nilai sebelum dihapus
                    //     $beratSebelumnya = $DryAPenerimaanCabutStock->berat_masuk;
                    //     $pcsSebelumnya = $DryAPenerimaanCabutStock->pcs_masuk;

                    //     // Hitung total modal baru
                    //     $totalBeratBaru = $beratSebelumnya - $DryAPenerimaanCabut->berat_grading;
                    //     $totalPcsBaru = $pcsSebelumnya - $DryAPenerimaanCabut->pcs_grading;

                    //     // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                    //     $DryAPenerimaanCabutStock->update([
                    //         'berat_masuk' => $totalBeratBaru,
                    //         'sisa_berat' => $totalBeratBaru,
                    //         'pcs_masuk' => $totalPcsBaru,
                    //         'sisa_pcs' => $totalPcsBaru,
                    //         'modal' => $totalPcsBaru,
                    //         'total_modal' => $totalPcsBaru * ($DryAPenerimaanCabutStock->sisa_berat + $DryAPenerimaanCabut['berat_grading']),
                    //     ]);
                    // }

                    // Hapus data GradingHalusInput
                    DryAPenerimaanCabutStock::where('nomor_job', '=', $DryAPenerimaanCabut->nomor_job)
                    ->delete();
              
                $DryAPenerimaanCabut->delete();

            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAPenerimaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAPenerimaan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
