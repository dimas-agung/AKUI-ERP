<?php

namespace App\Http\Controllers\PreWash;

use App\Models\PreWashInput;
use Illuminate\Http\Request;
use App\Models\TransitGradingHalus;
use App\Http\Controllers\Controller;

class PreWashInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreWashInput = PreWashInput::all();
        return response()->view('PreWash.PreWashInput.index', [
            'pre_wash_inputs' => $PreWashInput,
            'i' => $i,
        ]);
    }

    // create
    // public function create()
    // {
    //     $PreWashInput = PreWashInput::with('TransitGradingHalus')->get();
    //     return response()->view('PreWash.PreWashInput.create', compact('PreWashInput'));
    // }
    // create
    public function create()
    {
        $PreWashInput = PreWashInput::with('TransitGradingHalus')->get();
        $TransitGradingHalus = TransitGradingHalus::all();
        return view('PreWash.PreWashInput.create', [
            // 'pre_grading_halus_stocks' => $AdjustmentAdding,
            'grading_halus_stocks' => $PreWashInput,
            'transit_grading_haluses' => $TransitGradingHalus,
        ]);
    }
    // Set Nomor BSTB
    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = TransitGradingHalus::where('nomor_bstb', $nomor_bstb)->first();

        return response()->json($data);
    }
}
