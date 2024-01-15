<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarHasil;
use App\Models\GradingKasarStock;
use Illuminate\Http\Request;

class GradingKasarStockController extends Controller
{
    //Index
    public function index(){
        $i = 1;
        $GradingKasarHasil = GradingKasarHasil::with('GradingKasarStock')->get();
        $GKstock = GradingKasarStock::with('GradingKasarHasil')->get();

        return response()->view('transit_grading.GradingKasarStock.index', [
            'GKstock'       => $GKstock,
            'i'             => $i
        ]);
    }
}
