<?php

namespace App\Http\Controllers\DryA;

use App\Http\Controllers\Controller;
use App\Models\DryAGradingCabut;
use App\Models\DryAGradingCabutStock;
use App\Models\DryAOutputCabut;
use App\Models\TransitDryACabut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DryAOutputController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $PreCleaningI = DryAOutputCabut::get();
        // return $existingItem;

        return response()->view('DryA.DryAOutput.index', [
            'PreCleaningI' => $PreCleaningI,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $PreCleaningI = DryAOutputCabut::with('DryAGradingCabutStock')->get();
        $stockTGK = DryAGradingCabutStock::with('DryAOutputCabut')->get();
        // return $PrmRawMOIC;
        return view('DryA.DryAOutput.create', compact('stockTGK', 'PreCleaningI'));
    }

    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = DryAGradingCabutStock::where('nomor_job',$nomor_job)->first();
        $data = DryAGradingCabutStock::where('nomor_job',$nomor_job)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = DryAGradingCabutStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    // Contoh controller
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            // 'nomor_job' => 'required',
            'user_created' => 'required',
            'user_updated' => 'sometimes',
            'nomor_bstb' => 'required',
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
                'nomor_job' => 'required', // Ganti dengan nama field yang sesuai
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
                    DryAOutputCabut::create($mergedData);

                    TransitDryACabut::create([
                        'unit'                  => 'Pre Cleaning',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'],
                        'berat_kotor'         => $mergedData['berat_kotor'],
                        'jenis_grading'      => $mergedData['jenis_grading'],
                        'berat_1_grading'         => $mergedData['berat_1_grading'],
                        'pcs_1_grading'       => $mergedData['pcs_1_grading'],
                        'berat_2_grading'      => $mergedData['berat_2_grading'] ?? 0,
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = DryAGradingCabutStock::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'berat_kotor' => $itemObject->berat_kotors ?? 0,
                            'berat_1_grading'   => $itemObject->pcs_kirims ?? 0,
                            'pcs_1_grading'  => $itemObject->total_modals ?? 0,
                            'berat_2_grading' => $itemObject->user_createds ?? 0,
                            'status' => $itemObject->user_createds ?? 0,
                        ]);
                    }


                    $itemObject = (object) $mergedData;
                    $existingItem = DryAGradingCabut::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    $dataToUpdate = [
                        'status'                => $itemObject->status ?? 0,
                    ];

                    if ($existingItem) {
                            foreach ($existingItem as $existingItems) {
                                // Perbarui data untuk setiap item yang ada
                                $existingItems->update($dataToUpdate);
                            }
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('DryAOutput.create')
                    ],504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('DryAOutput.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data DryAOutputCabut berdasarkan nomor_job
            $PreCleaningInputs = DryAOutputCabut::where('nomor_job', '=', $nomor_job)->get();

            if ($PreCleaningInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('DryAOutput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            // Loop melalui setiap PreCleaningInput yang ditemukan
            foreach ($PreCleaningInputs as $PreCleaningI) {
                // Ambil semua data TransitDryACabut berdasarkan nomor_job dan nomor_bstb
                $PreCleaningStocks = TransitDryACabut::where('nomor_job', '=', $PreCleaningI->nomor_job)
                    ->where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
                    ->get();

                // Loop melalui setiap PreCleaningStock yang ditemukan
                foreach ($PreCleaningStocks as $PreCleaningS) {
                    // Ambil semua data DryAGradingCabutStock berdasarkan nomor_job
                    $stockPrmRawMaterials = DryAGradingCabutStock::where('nomor_job', '=', $PreCleaningI->nomor_job)
                        ->get();

                    // Loop melalui setiap DryAGradingCabutStock yang ditemukan
                    foreach ($stockPrmRawMaterials as $stockPrmRawMaterial) {
                        // Update data DryAGradingCabutStock dengan berat, pcs, dan total modal yang baru
                        $stockPrmRawMaterial->update([
                            'berat_kotor' => max($PreCleaningI->berat_kotor, 0),
                            'berat_1_grading' => max($PreCleaningI->berat_1_grading, 0),
                            'pcs_1_grading' => max($PreCleaningI->pcs_1_grading, 0),
                            'berat_2_grading' => max($PreCleaningI->berat_2_grading, 0),
                            'status' => max($PreCleaningI->berat_2_grading, 1),
                        ]);
                    }

                    // Ambil semua item DryAGradingCabut yang memiliki nomor_job yang sama
                    $existingItems = DryAGradingCabut::where('nomor_job', $nomor_job)->get();

                    // Logika Update Status
                    if ($existingItems->isNotEmpty()) {
                        foreach ($existingItems as $existingItem) {
                            // Perbarui data untuk setiap item yang ada
                            $existingItem->update(['status' => 1]);
                        }
                    } else {
                        // Jika tidak ada item DryAGradingCabut yang sesuai, buat baru dengan status 1
                        DryAGradingCabut::create([
                            'status' => 1,
                            // Tambahkan kolom-kolom lain sesuai kebutuhan
                        ]);
                    }

                    // Hapus data PreCleaningStock
                    $PreCleaningS->delete();
                }

                // Hapus data PreCleaningInput
                $PreCleaningI->delete();
            }


            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('DryAOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Redirect ke index dengan pesan error
            return redirect()->route('DryAOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
