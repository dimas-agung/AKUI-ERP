<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\PreGradingHalusStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Http\Request;

class PreGradingHalusStockController extends Controller
{
    //
    public function index(){
        $i =1;
        $TransitPre = PreGradingHalusStock::where('sisa_berat','>',0)->get();
        // return $TransitPre;

        return response()->view('PreGradingHalus.PreGradingHalusStock.index', [
            'TransitPre' => $TransitPre,
            'i' => $i,
        ]);
    }
}
