<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarOutput;
use App\Models\TransitGradingKasarStock;
use Illuminate\Http\Request;

class TransitGradingKasarStockController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $GradingKO = GradingKasarOutput::with('TransitGradingKasarStock')->get();
        $stockTGK = TransitGradingKasarStock::with('GradingKasarOutput')->get();
        // return $PrmRawMOI;
        return response()->view('transit_grading.TransitGradingKasarStock.index', [
            'stockTGK' => $stockTGK,
            'GradingKO' => $GradingKO,
            'i' => $i,
        ]);
    }
}
