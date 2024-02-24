<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\AdjustmentAdding;
use Illuminate\Http\Request;

class AdjustmentAddingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $AdjustmentAdding = AdjustmentAdding::all();
        return response()->view('PreGradingHalus.AdjustmentAdding.index', [
            'adjustment_addings' => $AdjustmentAdding,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        // $AdjustmentAdding = AdjustmentAdding::with('PreGradingHalusAdding')->get();
        $AdjustmentAdding = AdjustmentAdding::all();
        return view('PreGradingHalus.AdjustmentAdding.create', [
            'pre_grading_halus_stocks' => $AdjustmentAdding,
        ]);
    }
}
