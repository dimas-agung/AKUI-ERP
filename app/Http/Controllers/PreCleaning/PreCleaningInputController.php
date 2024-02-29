<?php

namespace App\Http\Controllers\PreCleaning;

use App\Models\GradingKasarOutput;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\PreCleaningInput;
use App\Models\StockTransitGradingKasar;
use App\Models\PreCleaningStock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PreCleaningInputController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $PreCleaningI = PreCleaningInput::with('StockTransitGradingKasar')->get();
        // $existingItem = StockTransitGradingKasar::with('PreCleaningInput')
        // ->get();
        // return $existingItem;

        // return $GradingKI;
        return response()->view('PreCleaning.PreCleaningInput.index', [
            'PreCleaningI' => $PreCleaningI,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $PreCleaningI = PreCleaningInput::with('StockTransitGradingKasar')->get();
        $stockTGK = StockTransitGradingKasar::with('PreCleaningInput')->get();
        // return $PrmRawMOIC;
        return view('PreCleaning.PreCleaningInput.create', compact('stockTGK', 'PreCleaningI'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = StockTransitGradingKasar::where('nomor_bstb',$nomor_bstb)->first();
        $data = StockTransitGradingKasar::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'doc_no' => 'required',
            'user_created' => 'required',
            'user_updated' => 'sometimes',
            'keterangan' => 'sometimes',
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
                'nomor_bstb' => 'required', // Ganti dengan nama field yang sesuai
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
                    PreCleaningInput::create($mergedData);

                    PreCleaningStock::create([
                        'nomor_job'             => $mergedData['nomor_job'],
                        'id_box_grading_kasar'  => $mergedData['id_box_grading_kasar'],
                        'nomor_bstb'    => $mergedData['nomor_bstb'],
                        'nomor_batch'   => $mergedData['nomor_batch'],
                        'nama_supplier' => $mergedData['nama_supplier'],
                        'id_box_raw_material'        => $mergedData['id_box_raw_material'],
                        'jenis_raw_material'         => $mergedData['jenis_raw_material'],
                        'avg_kadar_air'     => $mergedData['kadar_air'],
                        'tujuan_kirim'      => $mergedData['tujuan_kirim'],
                        'jenis_kirim'       => $mergedData['jenis_kirim'],
                        'berat_keluar'      => $mergedData['berat_keluar'] ?? 0,
                        'berat_masuk'       => $mergedData['berat_kirim'] ?? 0,
                        'pcs_keluar'        => $mergedData['pcs_keluar'] ?? 0,
                        'pcs_masuk'         => $mergedData['pcs_kirim'] ?? 0,
                        'nomor_grading'     => $mergedData['nomor_grading'],
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                        'keterangan'        => $mergedData['keterangan'] ?? 0,
                        'user_created'  => $mergedData['user_created'],
                        'user_update'   => $mergedData['user_updated'] ?? `"There isn't any"`,
                        'nomor_nota_internal'   => $mergedData['nomor_nota_internal']
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = StockTransitGradingKasar::where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'berat_keluar' => $itemObject->berat_kirims ?? 0,
                            'pcs_keluar'   => $itemObject->pcs_kirims ?? 0,
                            'total_modal'  => $itemObject->total_modals ?? 0,
                            'user_updated' => $itemObject->user_created ?? "There isn't any",
                        ]);
                    }


                    $itemObject = (object) $mergedData;
                    $existingItem = GradingKasarOutput::where('nama_supplier', $itemObject->nama_supplier)
                        ->where('nomor_bstb', $itemObject->nomor_bstb)
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
                        'redirectTo' => route('PreCleaningInput.create')
                    ],504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('PreCleaningInput.index')
        ], 201);
    }


    public function destroy($nomor_bstb): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_bstb
            $PreCleaningInputs = PreCleaningInput::where('nomor_bstb', '=', $nomor_bstb)->get();

            if ($PreCleaningInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('PreCleaningInput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($PreCleaningInputs as $PreCleaningI) {
                // Ambil data PreCleaningStock berdasarkan id_box_grading_kasar dan id_box_raw_material
                $PreCleaningS = PreCleaningStock::where('nomor_job', '=', $PreCleaningI->nomor_job)
                    ->where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
                    ->first();

                if ($PreCleaningS) {
                    // Ambil data StockTransitGradingKasar berdasarkan id_box_grading_kasar dan id_box_raw_material
                    $stockPrmRawMaterial = StockTransitGradingKasar::where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
                        ->where('nomor_job', '=', $PreCleaningI->nomor_job)
                        ->first();

                    if ($stockPrmRawMaterial) {
                        // Simpan nilai sebelum dihapus
                        $beratSebelumnya = $stockPrmRawMaterial->berat_keluar;
                        $pcsSebelumnya = $stockPrmRawMaterial->pcs_keluar;
                        $totalModalSebelumnya = $stockPrmRawMaterial->total_modal;

                        // Hitung perbedaan berat dan pcs
                        $perbedaanBerat = $PreCleaningI->berat_kirim;
                        $perbedaanPcs = $PreCleaningI->pcs_kirim;

                        // Hitung total modal baru
                        $totalModalBaru = $totalModalSebelumnya - ($beratSebelumnya * $PreCleaningI->modal);

                        // Update data StockTransitGradingKasar dengan berat, pcs, dan total modal yang baru
                        $stockPrmRawMaterial->update([
                            'berat_keluar' => max($beratSebelumnya - $perbedaanBerat, 0),
                            'pcs_keluar' => max($pcsSebelumnya - $perbedaanPcs, 0),
                            'total_modal' => max($totalModalBaru, 0),
                        ]);
                    }
                }

                // Simpan data sebelum dihapus
                $beratSebelumHapus = $PreCleaningI->berat_kirim;
                $pcsSebelumHapus = $PreCleaningI->pcs_kirim;
                $totalModalSebelumHapus = $PreCleaningI->total_modal;

                // Hapus data PreCleaningInput dan PreCleaningStock
                $PreCleaningI->delete();
                if ($PreCleaningS) {
                    $PreCleaningS->delete();
                }

                // Kembalikan nilai sebelum dihapus
                if ($stockPrmRawMaterial) {
                    $stockPrmRawMaterial->update([
                        'berat_keluar' => $stockPrmRawMaterial->berat_keluar + $beratSebelumHapus,
                        'pcs_keluar' => $stockPrmRawMaterial->pcs_keluar + $pcsSebelumHapus,
                        'total_modal' => $stockPrmRawMaterial->total_modal + $totalModalSebelumHapus,
                    ]);
                }

                $existingItems = GradingKasarOutput::where('nama_supplier', $PreCleaningI->nama_supplier)
                ->where('nomor_bstb', $PreCleaningI->nomor_bstb)
                ->get();

                // Logika Update Status
                if ($existingItems) {
                    foreach ($existingItems as $existingItem) {
                        // Perbarui data untuk setiap item yang ada
                        $existingItem->update(['status' => 1]);
                    }
                } else {
                    // Jika tidak ada item GradingKasarOutput yang sesuai, buat baru dengan status 1
                    GradingKasarOutput::create([
                        'nomor_bstb' => $PreCleaningI->nomor_bstb,
                        'status' => 1,
                        // Tambahkan kolom-kolom lain sesuai kebutuhan
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('PreCleaningInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('PreCleaningInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
