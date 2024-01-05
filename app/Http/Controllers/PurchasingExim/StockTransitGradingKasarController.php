<?php

namespace App\Http\Controllers\PurchasingExim;

//return type View
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialOutputHeader;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class StockTransitGradingKasarController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $stockTGK = StockTransitGradingKasar::with('PramRawMaterialOutputItems')->get();
        // $PrmRawMOH = PrmRawMaterialOutputHeader::with('StockTransitGradingKasar')->get();
        $PrmRawMOI = PrmRawMaterialOutputItem::with('StockTransitGradingKasar')->get();
        // return $PrmRawMOI;
        return response()->view('purchasing_exim.StockTransitGradingKasar.index', [
            'stockTGK' => $stockTGK,
            'PrmRawMOI' => $PrmRawMOI,
            'i' => $i,
        ]);
    }
}
