<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\GradingHalusAdjustmentStock;
use Illuminate\Http\Request;

class GradingHalusAdjustmentStockController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $GradingHalusAdjustmentStock = GradingHalusAdjustmentStock::all();
        return response()->view('PreGradingHalus.AdjustmentStock.index', [
            'grading_halus_adjustment_stocks' => $GradingHalusAdjustmentStock,
            'i' => $i,
        ]);
    }
}
