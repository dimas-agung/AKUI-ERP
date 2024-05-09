<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PreGradingHalusStock;
use App\Models\PreGradingHalusAdding;
use App\Services\PreGradingHalusAddingService;
use App\Http\Requests\PreGradingHalusAddingRequest;
use App\Models\PreGradingHalusAddingStock;

class PreGradingHalusAddingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreGradingHalusAdding = PreGradingHalusAdding::all();
        return response()->view('PreGradingHalus.PreGradingHalusAdding.index', [
            'pre_grading_halus_addings' => $PreGradingHalusAdding,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreGradingHalusStock = PreGradingHalusStock::with('PreGradingHalusAdding')->get();
        $Perusahaan = Perusahaan::all();
        return view('PreGradingHalus.PreGradingHalusAdding.create', [
            'pre_grading_halus_stocks' => $PreGradingHalusStock,
            'perusahaan' => $Perusahaan,
        ]);
    }
    // get Data Stock Grading Halus
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreGradingHalusStock::where('nomor_job', $nomor_job)->first();

        return response()->json($data);
    }
    // get Data Perusahaan
    public function getDataPerusahaan(Request $request)
    {
        $nama = $request->nama;
        $data = Perusahaan::where('nama', $nama)
            ->where('status', 1)
            ->first();

        return response()->json($data);
    }

    public function simpanData(
        PreGradingHalusAddingRequest $request,
        PreGradingHalusAddingService $PreGradingHalusAddingService
    ) {
        $dataArray = json_decode($request->input('data'));

        $result = $PreGradingHalusAddingService->simpanData($dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Begin transaction
            DB::beginTransaction();
            // Temukan record berdasarkan nomor_$id
            // $PreCleaningOutput = PreCleaningOutput::findOrFail($id);
            $PreCleaningOutput = PreGradingHalusAdding::findOrFail($id);
            // Hapus semua item terkait
            // $stockPRM = TransitPreCleaningStock::where('id_box_raw_material', '=', $PreCleaningOutput->id_box_raw_material)
            //     ->where('nomor_job', $PreCleaningOutput->nomor_job)
            //     ->first();
            $stockPRM = PreGradingHalusAddingStock::where('id_box_raw_material', '=', $PreCleaningOutput->id_box_raw_material)
                ->where('nomor_grading', $PreCleaningOutput->nomor_grading)
                ->first();

            if ($stockPRM) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                if ($stockPRM->berat_adding === 0) {
                    $stockPRM->delete();
                } else {
                    // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                    if ($PreCleaningOutput->berat_kirim >= $stockPRM->berat_adding) {
                        $stockPRM->delete();
                    } else {
                        // Ambil berat sebelumnya
                        $beratSebelumnya = $stockPRM->berat_adding;
                        $pcsSebelumnya = $stockPRM->pcs_adding;

                        // Hitung total modal baru berdasarkan perbedaan berat
                        $perbedaanBerat = $beratSebelumnya - $PreCleaningOutput->berat_kirim;
                        $perbedaanPcs = $pcsSebelumnya - $PreCleaningOutput->pcs_kirim;
                        $totalModalBaru = $perbedaanBerat * $PreCleaningOutput->modal;

                        // Update data dengan berat dan total modal yang baru
                        $dataToUpdate = [
                            'berat_adding' => abs($perbedaanBerat),
                            'pcs_adding' => abs($perbedaanPcs),
                            'total_modal' => abs($totalModalBaru),
                        ];

                        // Perbarui data
                        $stockPRM->update($dataToUpdate);
                    }
                }
            }

            $existingItems = PreGradingHalusStock::where('nomor_job', $PreCleaningOutput->nomor_job)
                ->where('id_box_grading_kasar', $PreCleaningOutput->id_box_grading_kasar)
                ->get();

            // Logika Update Status
            foreach ($existingItems as $existingItem) {

                // Perbarui data untuk setiap item yang ada
                if ($existingItem) {
                    $beratSebelumnya = $existingItem->berat_keluar;
                    $pcsSebelumnya = $existingItem->pcs_keluar;
                    // $sisaBerat = $existingItem->berat_keluar - $PreCleaningOutput->berat_kirim;

                    // Hitung total modal baru berdasarkan perbedaan berat
                    $perbedaanBerat = $beratSebelumnya - $PreCleaningOutput->berat_kirim;
                    $perbedaanPcs = $pcsSebelumnya - $PreCleaningOutput->pcs_kirim;
                    $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;
                    $sisaPcs = $existingItem->pcs_keluar - $perbedaanPcs;
                    $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;
                    $totalModalBaru = $sisaBerat * $PreCleaningOutput->modal;

                    $existingItem->update(['berat_keluar'   => $perbedaanBerat]);
                    $existingItem->update(['sisa_berat'     => $sisaBerat]);
                    $existingItem->update(['pcs_keluar'     => $perbedaanPcs]);
                    $existingItem->update(['sisa_pcs'       => $sisaPcs]);
                    $existingItem->update(['total_modal'    => $totalModalBaru]);
                    $existingItem->update(['status' => 1]);
                }
            }

            $existingItem = PreGradingHalusAdding::where('nomor_job', $PreCleaningOutput->nomor_job)
                ->where('id_box_raw_material', $PreCleaningOutput->id_box_raw_material)
                ->first();

            $dataToUpdate = [
                'status'                => $PreCleaningOutput->status ?? 0,
            ];

            if ($existingItem) {
                // Perbarui data
                $existingItem->update($dataToUpdate);
            }

            // Hapus record utama
            $PreCleaningOutput->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('PreGradingHalusAdding.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('PreGradingHalusAdding.index')->with('error', 'Gagal menghapus data');
        }
    }
}
