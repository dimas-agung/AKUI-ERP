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
        $data = StockTransitGradingKasar::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function store(Request $request)
    {
        //validate form
        $validatedData = $request->validate([
            'doc_no'   => 'required',
            'nomor_job'   => 'required',
            'id_box_grading_kasar'   => 'required',
            'nomor_bstb'   => 'required',
            'nomor_batch'   => 'required',
            'nama_supplier'   => 'required',
            'nomor_nota_internal'   => 'required',
            'id_box_raw_material'   => 'required',
            'jenis_raw_material'   => 'required',
            'jenis_kirim'   => 'required',
            'berat_kirim'   => 'required',
            'pcs_kirim'   => 'required',
            'kadar_air'   => 'required',
            'tujuan_kirim'   => 'required',
            'nomor_grading'   => 'required',
            'modal'   => 'required',
            'total_modal'   => 'required',
            'user_created'   => 'required',
            'user_updated'   => 'required',
            'keterangan'   => 'required',
        ]);
        $newData = [];

        foreach ($validatedData as $data) {
            $newData[] = PreCleaningInput::create($data);
        }

        // Kembalikan data yang baru dibuat sebagai respons
    return response()->json([
        'data' => $newData,
        'success' => true, 'message' => 'Data berhasil disimpan!', 'redirectTo' => route('PreCleaningInput.index')], 201);
        //redirect to index
        // return redirect()->route('PreCleaningInput.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
