<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\AdjustmentInput;
use App\Models\AdjustmentStock;
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
        $AdjustmentStock = AdjustmentStock::with('AdjustmentInput')->get();
        return view('PreGradingHalus.AdjustmentInput.create', [
            // 'pre_grading_halus_stocks' => $AdjustmentAdding,
            'adjustment_inputs' => $AdjustmentStock,
        ]);
    }
}
