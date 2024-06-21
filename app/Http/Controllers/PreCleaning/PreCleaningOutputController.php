<?php

namespace App\Http\Controllers\PreCleaning;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\MasterOperator;
use App\Models\PreCleaningInput;
use App\Models\PreCleaningStock;
use App\Models\PreCleaningOutput;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\TransitPreCleaningStock;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Services\PreCleaningOutputService;
use App\Http\Requests\PreCleaningOutputRequest;

class PreCleaningOutputController extends Controller
{
    protected $preCleaningOutputs = null;
    protected $preCleaningStock = null;

    public function getPreCleaningOutputs()
    {
        if ($this->preCleaningOutputs === null) {
            $this->preCleaningOutputs = PreCleaningOutput::all();
        }
        return $this->preCleaningOutputs;
    }

    public function getPreCleaningStock()
    {
        if ($this->preCleaningStock === null) {
            $this->preCleaningStock = PreCleaningStock::where('status', 1)->get();
        }
        return $this->preCleaningStock;
    }


    // Index
    public function index()
    {
        return response()->view('PreCleaning.PreCleaningOutput.index', [
            'pre_cleaning_outputs' => $this->getPreCleaningOutputs()
        ]);
    }
    // create
    public function create()
    {
        $preCleaningStock = $this->getPreCleaningStock()->where('sisa_berat', '!=', 0);
        $MasterOperator = MasterOperator::where('status', 1)->get();
        $Perusahaan = Perusahaan::where('status', 1)->get();
        return view('PreCleaning.PreCleaningOutput.create', [
            'pre_cleaning_stocks'       => $preCleaningStock,
            'master_operators'          => $MasterOperator,
            'perusahaan'                => $Perusahaan,
        ]);
    }

    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = $this->getPreCleaningStock()->where('nomor_job', $nomor_job)
            ->first();
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
            // $PreCleaningOutput = $this->preCleaningOutputs->findOrFail($nomor_job);
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

            // $existingItems = $this->preCleaningStock->where('nomor_job', $PreCleaningOutput->nomor_job)
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
