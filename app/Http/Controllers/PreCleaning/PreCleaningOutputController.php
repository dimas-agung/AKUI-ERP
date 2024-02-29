<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreCleaningOutputRequest;
use App\Models\MasterOperator;
use App\Models\PreCleaningInput;
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
    public function index()
    {
        $i = 1;
        $PreCleaningOutput = PreCleaningOutput::all();
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
        $MasterOperator = MasterOperator::with('PreCleaningOutput')->get();
        return view('PreCleaning.PreCleaningOutput.create', [
            'pre_cleaning_outputs'      => $PreCleaningOutput,
            'pre_cleaning_stocks'       => $PreCleaningStock,
            'master_operators'          => $MasterOperator,
        ]);
    }
    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreCleaningStock::where('nomor_job', $nomor_job)
            ->whereRaw('berat_masuk - berat_keluar != 0') // Tambahkan kondisi ini
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

    public function destroy($id): RedirectResponse
    {
        try {
            // Begin transaction
            DB::beginTransaction();
            // Temukan record berdasarkan ID
            $PreCleaningOutput = PreCleaningOutput::findOrFail($id);
            // $TransitPreCleaningStock = TransitPreCleaningStock::findOrFail($id)

            // Ambil data StockTransitRawMaterial berdasarkan nomor_bstb
            $stockGradingKasar = PreCleaningStock::where('id_box_raw_material', '=', $PreCleaningOutput->id_box_raw_material)
            ->where('nomor_job', '=', $PreCleaningOutput->nomor_job)
            ->first();

            if ($stockGradingKasar) {
                // Simpan nilai sebelum dihapus
                $beratTadi = $PreCleaningOutput->berat_keluar;
                $beratSebelumnya = $stockGradingKasar->berat_keluar;
                $PcsTadi = $PreCleaningOutput->pcs_keluar;
                $PcsSebelumnya = $stockGradingKasar->pcs_keluar;
                $Modal = $PreCleaningOutput->modal;

                $Beratkeluar = $beratSebelumnya - $beratTadi;
                $PcsKeluar = $PcsSebelumnya - $PcsTadi;
                $TotalModal = $Beratkeluar * $Modal;

                // Update data pada PrmRawMaterialStock
                $dataToUpdate = [
                    'berat_keluar' => $Beratkeluar,
                    'pcs_keluar' => $PcsKeluar,
                    'total_modal' => $TotalModal,
                ];

                // Perbarui data pada PrmRawMaterialStock
                $stockGradingKasar->update($dataToUpdate);
            }

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

            $existingItems = PreCleaningInput::where('nomor_job', $PreCleaningOutput->nomor_job)
            ->where('id_box_grading_kasar', $PreCleaningOutput->id_box_grading_kasar)
            ->get();

            // Logika Update Status
            foreach ($existingItems as $existingItem) {
                // Perbarui data untuk setiap item yang ada
                if ($existingItem->berat_kirim === $PreCleaningOutput->berat_keluar) {
                    $existingItem->update(['status' => 1]);
                }
            }

            // Jika tidak ada item PreCleaningInput yang sesuai, buat baru dengan status 1
            if ($existingItems->isEmpty()) {
                PreCleaningInput::create([
                    'nomor_bstb' => $PreCleaningOutput->nomor_bstb,
                    'status' => 1,
                    // Tambahkan kolom-kolom lain sesuai kebutuhan
                ]);
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
