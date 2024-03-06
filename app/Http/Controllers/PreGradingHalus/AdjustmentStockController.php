<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\AdjustmentStock;
use Illuminate\Http\Request;

class AdjustmentStockController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $AdjustmentStock = AdjustmentStock::all();
        return response()->view('PreGradingHalus.AdjustmentStock.index', [
            'adjustment_stocks' => $AdjustmentStock,
            'i' => $i,
        ]);
    }
}
