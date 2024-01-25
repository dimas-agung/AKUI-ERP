<?php

namespace App\Http\Controllers\PreCleaning;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PreClaningInputRequest;
use App\Models\PreCleaningInput;
use App\Models\StockTransitGradingKasar;
use App\Models\PreCleaningStock;
use App\Services\PreClaningInputService;
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

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'doc_no'   => 'required',
            'nomor_job'   => 'required',
            'id_box_grading_kasar'   => 'required',
            'nomor_bstb'   => 'required',
            'nomor_batch'   => 'required',
            'nama_supplier'   => 'required',
            'nomor_nota_internal'   => 'required',
            'id_box_raw_material'   => 'required',
            'jenis_raw_material'   => 'required',
            'jenis_grading'   => 'required',
            'berat_keluar'   => 'required',
            'pcs_keluar'   => 'required',
            'avg_kadar_air'   => 'required',
            'tujuan_kirim'   => 'required',
            'nomor_grading'   => 'required',
            'modal'   => 'required',
            'total_modal'   => 'required',
        ], [
            'nama.required' => 'Kolom Nama Biaya Wajib diisi.',
            'workstation_id.required' => 'Kolom Inisial Biaya Wajib diisi.'
        ]);

        //create post
        PreCleaningInput::create([
            'doc_no' => $request->doc_no,
            'nomor_job' => $request->nomor_job,
            'id_box_grading_kasar' => $request->id_box_grading_kasar,
            'nomor_bstb' => $request->nomor_bstb,
            'nomor_batch' => $request->nomor_batch,
            'nama_supplier' => $request->nama_supplier,
            'nomor_nota_internal' => $request->nomor_nota_internal,
            'id_box_raw_material' => $request->id_box_raw_material,
            'jenis_raw_material' => $request->jenis_raw_material,
            'jenis_kirim' => $request->jenis_grading,
            'berat_kirim' => $request->berat_keluar,
            'pcs_kirim' => $request->pcs_keluar,
            'kadar_air' => $request->avg_kadar_air,
            'tujuan_kirim' => $request->tujuan_kirim,
            'nomor_grading' => $request->nomor_grading,
            'modal' => $request->modal,
            'total_modal' => $request->total_modal,
            'keterangan' => $request->keterangan,
            'user_created' => $request->user_created,
            'user_updated' => $request->user_updated ?? "There isn't any",
        ]);

        // Creat Stock Transit Grading Kasar
        $existingItem = PreCleaningStock::where('nomor_bstb', $request->nomor_bstb)
            ->where('nomor_job', $request->nomor_job)
            ->first();
            // return $existingItem

        $dataToUpdate = [
            'nomor_job'             => $request->nomor_job,
            'nomor_bstb'            => $request->nomor_bstb,
            'id_box_grading_kasar'  => $request->id_box_grading_kasar,
            'nomor_batch'           => $request->nomor_batch,
            'nama_supplier'         => $request->nama_supplier,
            'nomor_nota_internal'   => $request->nomor_nota_internal,
            'id_box_raw_material'   => $request->id_box_raw_material,
            'jenis_raw_material'    => $request->jenis_raw_material,
            'jenis_kirim'           => $request->jenis_grading,
            'tujuan_kirim'          => $request->tujuan_kirim,
            'pcs_masuk'             => $request->pcs_keluar,
            'berat_keluar'          => $request->berat_masuk ?? 0,
            'berat_masuk'          => $request->berat_keluar,
            'pcs_keluar'     => $request->pcs_masuk ?? 0,
            'avg_kadar_air'  => $request->avg_kadar_air,
            'nomor_grading'  => $request->nomor_grading,
            'modal'         => $request->modal,
            'total_modal'   => $request->total_modal,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_update'  => $request->user_updated ?? "There isn't any"
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Jika item sudah ada, perbarui data
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            PreCleaningStock::create($dataToUpdate);
        }

        //redirect to index
        return redirect()->route('PreCleaningInput.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $PreCleaningI = PreCleaningInput::findOrFail($id);

        //delete post
        $PreCleaningI->delete();

        //redirect to index
        return redirect()->route('PreCleaningInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
