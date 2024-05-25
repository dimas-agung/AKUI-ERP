<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\GradingHalusStock;
use Illuminate\Http\Request;

class GradingHalusStockContoller extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $GradigHalusStock = GradingHalusStock::where('sisa_berat','>',0)->get();
        return response()->view('PreGradingHalus.GradingHalusStock.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
