<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreCleaningOutputRequest;
use App\Models\MasterOperator;
use App\Models\PreCleaningInput;
use App\Models\Perusahaan;
use App\Models\PreCleaningOutput;
use App\Models\PreCleaningStock;
use App\Models\TransitPreCleaningStock;
use App\Services\PreCleaningOutputService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PreCleaningOutputController extends Controller
{
    //index
    public function index(Request $request)
    {
        // $i = 1;
        // $PreCleaningOutput = PreCleaningOutput::all();
        // return response()->view('PreCleaning.PreCleaningOutput.index', [
        //     'pre_cleaning_outputs' => $PreCleaningOutput,
        //     'i' => $i,
        // ]);
        $i = 1;
        $PreCleaningOutput = PreCleaningOutput::limit(1000)->latest()->get();
        return response()->view('PreCleaning.PreCleaningOutput.index', [
            'pre_cleaning_outputs' => $PreCleaningOutput,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreCleaningStock = PreCleaningStock::with('PreCleaningOutput')->get();
        $PreCleaningOutput = PreCleaningOutput::with('PreCleaningStock')->whereRaw('berat_masuk - berat_keluar != 0');
        $MasterOperator = MasterOperator::all();
        $Perusahaan = Perusahaan::all();
        return view('PreCleaning.PreCleaningOutput.create', [
            'pre_cleaning_outputs'      => $PreCleaningOutput,
            'pre_cleaning_stocks'       => $PreCleaningStock,
            'master_operators'          => $MasterOperator,
            'perusahaan'                => $Perusahaan,
        ]);
    }
    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreCleaningStock::where('nomor_job', $nomor_job)
            // ->whereRaw('berat_masuk - berat_keluar != 0') // Tambahkan kondisi ini
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }

    public function simpanData(
        PreCleaningOutputRequest $request,
        PreCleaningOutputService $PreCleaningOutputService
    ) {
        $dataArray = json_decode($request->input('data'));

        $result = $PreCleaningOutputService->simpanData($dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }

    public function destroy($nomor_job)
    {
        try {
            // Begin transaction
            DB::beginTransaction();
            // Temukan record berdasarkan ID
            $PreCleaningOutput = PreCleaningOutput::findOrFail($nomor_job);
            // Hapus semua item terkait
            $stockPRM = TransitPreCleaningStock::where('id_box_raw_material', '=', $PreCleaningOutput->id_box_raw_material)
                ->where('nomor_job', $PreCleaningOutput->nomor_job)
                ->first();

            if ($stockPRM) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                if ($stockPRM->berat_kirim === 0) {
                    $stockPRM->delete();
                } else {
                    // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                    if ($PreCleaningOutput->berat_kirim >= $stockPRM->berat_kirim) {
                        $stockPRM->delete();
                    } else {
                        // Ambil berat sebelumnya
                        $beratSebelumnya = $stockPRM->berat_kirim;
                        $pcsSebelumnya = $stockPRM->pcs_kirim;

                        // Hitung total modal baru berdasarkan perbedaan berat
                        $perbedaanBerat = $beratSebelumnya - $PreCleaningOutput->berat_kirim;
                        $perbedaanPcs = $pcsSebelumnya - $PreCleaningOutput->pcs_kirim;
                        $totalModalBaru = $perbedaanBerat * $PreCleaningOutput->modal;

                        // Update data dengan berat dan total modal yang baru
                        $dataToUpdate = [
                            'berat_kirim' => abs($perbedaanBerat),
                            'pcs_kirim' => abs($perbedaanPcs),
                            'total_modal' => abs($totalModalBaru),
                        ];

                        // Perbarui data
                        $stockPRM->update($dataToUpdate);
                    }
                }
            }

            $existingItems = PreCleaningStock::where('nomor_job', $PreCleaningOutput->nomor_job)
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

            $existingItem = PreCleaningInput::where('nomor_job', $PreCleaningOutput->nomor_job)
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

            return redirect()->route('PreCleaningOutput.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('PreCleaningOutput.index')->with('error', 'Gagal menghapus data');
        }
    }
}
