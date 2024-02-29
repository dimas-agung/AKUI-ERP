<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarOutput;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;

class StockTransitGradingKasarController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $GradingKO = GradingKasarOutput::with('StockTransitGradingKasar')->get();
        $stockTGK = StockTransitGradingKasar::with('GradingKasarOutput')->get();
        // return $PrmRawMOI;
        return response()->view('transit_grading.StockTransitGradingKasar.index', [
            'stockTGK' => $stockTGK,
            'GradingKO' => $GradingKO,
            'i' => $i,
        ]);
    }
}
