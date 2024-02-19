<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;

class PreGradingHalusAddingStockController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreGradingHalusAddingStock = PreGradingHalusAddingStock::all();
        return response()->view('PreGradingHalus.PreGradingHalusAddingStock.index', [
            'pre_grading_halus_adding_stocks' => $PreGradingHalusAddingStock,
            'i' => $i,
        ]);
    }
}
