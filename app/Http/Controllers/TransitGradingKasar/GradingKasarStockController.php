<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradingKasarStock;

class GradingKasarStockController extends Controller
{
    //
    //index
    public function index()
    {
        $i = 1;
        $GradigKasarStock = GradingKasarStock::all();
        return response()->view('transit_grading.GradingKasarStock.index', [
            'grading_kasar_stocks'          => $GradigKasarStock,
            'i'                             => $i
        ]);
    }
}
