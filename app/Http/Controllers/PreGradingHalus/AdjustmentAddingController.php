<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\AdjustmentAdding;
use App\Models\GradingHalusStock;
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
    // get data id Box
    public function set(Request $request)
    {
        $id_box_grading_halus = $request->id_box_grading_halus;
        $data = GradingHalusStock::where('id_box_grading_halus', $id_box_grading_halus)->first();

        return response()->json($data);
    }
}
