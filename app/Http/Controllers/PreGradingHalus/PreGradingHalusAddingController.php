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
use App\Models\PreGradingHalusInput;

class PreGradingHalusAddingController extends Controller
{
    protected $PreGradingHalusAdding = null;
    protected $PreGradingHalusStock = null;
    protected $Perusahaan = null;

    public function getPreGradingHalusAdding()
    {
        if ($this->PreGradingHalusAdding === null) {
            $this->PreGradingHalusAdding = PreGradingHalusAdding::all();
        }
        return $this->PreGradingHalusAdding;
    }

    public function getPreGradingHalusStock()
    {
        if ($this->PreGradingHalusStock === null) {
            $this->PreGradingHalusStock = PreGradingHalusStock::where('sisa_berat', '!=', 0)->get();
        }
        return $this->PreGradingHalusStock;
    }
    public function getPerusahaan()
    {
        if ($this->Perusahaan === null) {
            $this->Perusahaan = Perusahaan::where('status', 1)->get();
        }
        return $this->Perusahaan;
    }
    //index
    public function index(Request $request)
    {
        $i = 1;
        // $PreGradingHalusAdding = PreGradingHalusAdding::all();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = PreGradingHalusAdding::query();


        if ($startDate && $endDate) {
            $query->whereBetween(PreGradingHalusAdding::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGradingHalusAdding = $query->get();
        }else{
            $PreGradingHalusAdding = PreGradingHalusAdding::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('PreGradingHalus.PreGradingHalusAdding.index', [
            'pre_grading_halus_addings' =>$PreGradingHalusAdding,
        ]);
    }
    // create
    public function create()
    {
        return view('PreGradingHalus.PreGradingHalusAdding.create', [
            'pre_grading_halus_stocks' => $this->getPreGradingHalusStock(),
            'perusahaan' => $this->getPerusahaan(),
        ]);
    }
    // get Data Stock Grading Halus
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = $this->getPreGradingHalusStock()->where('nomor_job', $nomor_job)->first();

        return response()->json($data);
    }
    // get Data Perusahaan
    public function getDataPerusahaan(Request $request)
    {
        $nama = $request->nama;
        $data = $this->Perusahaan()->where('nama', $nama)
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
            $PreGradingHalusAdding = PreGradingHalusAdding::findOrFail($id);
            // Hapus semua item terkait
            $stockPRM = PreGradingHalusAddingStock::where('id_box_raw_material', '=', $PreGradingHalusAdding->id_box_raw_material)
                ->where('nomor_grading', $PreGradingHalusAdding->nomor_grading)
                ->first();

            if ($stockPRM) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                if ($stockPRM->berat_adding === 0) {
                    $stockPRM->delete();
                } else {
                    // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                    if ($PreGradingHalusAdding->berat_kirim >= $stockPRM->berat_adding) {
                        $stockPRM->delete();
                    } else {
                        // Ambil berat sebelumnya
                        $beratSebelumnya = $stockPRM->berat_adding;
                        $pcsSebelumnya = $stockPRM->pcs_adding;
                        $totalModalSebelumnya = $stockPRM->total_modal;

                        // Hitung total modal baru berdasarkan perbedaan berat
                        $perbedaanBerat = $beratSebelumnya - $PreGradingHalusAdding->berat_kirim;
                        $perbedaanPcs = $pcsSebelumnya - $PreGradingHalusAdding->pcs_kirim;
                        $totalModalBaru = $totalModalSebelumnya - $PreGradingHalusAdding->total_modal;
                        $modalBaru = $totalModalBaru / $perbedaanBerat;

                        // Update data dengan berat dan total modal yang baru
                        $dataToUpdate = [
                            'berat_adding' => abs($perbedaanBerat),
                            'pcs_adding' => abs($perbedaanPcs),
                            'modal' => abs($modalBaru),
                            'total_modal' => abs($totalModalBaru),
                        ];

                        // Perbarui data
                        $stockPRM->update($dataToUpdate);
                    }
                }
            }

            $existingItems = PreGradingHalusStock::where('nomor_job', $PreGradingHalusAdding->nomor_job)
                ->where('id_box_grading_kasar', $PreGradingHalusAdding->id_box_grading_kasar)
                ->get();

            // Logika Update Status
            foreach ($existingItems as $existingItem) {

                // Perbarui data untuk setiap item yang ada
                if ($existingItem) {
                    $beratSebelumnya = $existingItem->berat_keluar;
                    $pcsSebelumnya = $existingItem->pcs_keluar;
                    // $sisaBerat = $existingItem->berat_keluar - $PreGradingHalusAdding->berat_kirim;

                    // Hitung total modal baru berdasarkan perbedaan berat
                    $perbedaanBerat = $beratSebelumnya - $PreGradingHalusAdding->berat_kirim;
                    $perbedaanPcs = $pcsSebelumnya - $PreGradingHalusAdding->pcs_kirim;
                    $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;
                    $sisaPcs = $existingItem->pcs_keluar - $perbedaanPcs;
                    $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;
                    $totalModalBaru = $sisaBerat * $PreGradingHalusAdding->modal;

                    $existingItem->update(['berat_keluar'   => $perbedaanBerat]);
                    $existingItem->update(['sisa_berat'     => $sisaBerat]);
                    $existingItem->update(['pcs_keluar'     => $perbedaanPcs]);
                    $existingItem->update(['sisa_pcs'       => $sisaPcs]);
                    $existingItem->update(['total_modal'    => $totalModalBaru]);
                    $existingItem->update(['status' => 1]);
                }
            }

            $existingItem = PreGradingHalusAdding::where('nomor_job', $PreGradingHalusAdding->nomor_job)
                ->where('id_box_raw_material', $PreGradingHalusAdding->id_box_raw_material)
                ->first();

            $dataToUpdate = [
                'status'                => $PreGradingHalusAdding->status ?? 0,
            ];

            if ($existingItem) {
                // Perbarui data
                $existingItem->update($dataToUpdate);
            }

            $PreGradingHalusInput = PreGradingHalusInput::where('nomor_job', $PreGradingHalusAdding->nomor_job)
                // ->where('id_box_grading_kasar', $PreGradingHalusAdding->id_box_grading_kasar)
                ->update([
                    'status' => 1,
                ]);

            // Logika Update Status
            // foreach ($PreGradingHalusInput as $item) {
            //     if ($item) {

            //         $item->update([
            //             'status' => 1,
            //         ]);
            //     }
            // }

            // Hapus record utama
            $PreGradingHalusAdding->delete();

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
