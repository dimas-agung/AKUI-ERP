<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\GradingHalusStock;
use Illuminate\Http\Request;

class GradingHalusStockController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $GradigHalusStock = GradingHalusStock::where('sisa_berat', '>', 0)->get();
        // return $GradigHalusStock;
        return response()->view('PreGradingHalus.GradingHalusStock.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
