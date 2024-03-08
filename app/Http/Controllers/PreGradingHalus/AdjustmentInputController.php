<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\AdjustmentInput;
use App\Models\AdjustmentStock;
use App\Models\MasterJenisGradingHalus;
use Illuminate\Http\Request;

class AdjustmentInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $AdjustmentInput = AdjustmentInput::all();
        return response()->view('PreGradingHalus.AdjustmentInput.index', [
            'adjustment_inputs' => $AdjustmentInput,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        // $MasterJenisGradingHalus = MasterJenisGradingHalus::with('AdjustmentInput')->get();
        $MasterJenisGradingHalus = MasterJenisGradingHalus::all();
        $AdjustmentStock = AdjustmentStock::with('AdjustmentInput')->get();
        return view('PreGradingHalus.AdjustmentInput.create', [
            'adjustment_inputs' => $AdjustmentStock,
            'master_jenis_grading_halus' => $MasterJenisGradingHalus,
        ]);
    }

    // get data id Box
    public function getNomorAdjustment(Request $request)
    {
        $nomor_adjustment = $request->nomor_adjustment;
        $data = AdjustmentStock::where('nomor_adjustment', $nomor_adjustment)->first();

        return response()->json($data);
    }

    // get data id Box
    public function getJenisGradingHalus(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisGradingHalus::where('jenis', $jenis)->first();

        return response()->json($data);
    }
}
