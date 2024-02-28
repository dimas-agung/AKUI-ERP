<?php

namespace App\Http\Controllers\PurchasingExim;

//return type View
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\StockTransitRawMaterial;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class StockTransitRawMaterialController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $stockTGK = StockTransitRawMaterial::with('PramRawMaterialOutputItems')->get();
        // $PrmRawMOH = PrmRawMaterialOutputHeader::with('StockTransitRawMaterial')->get();
        $PrmRawMOI = PrmRawMaterialOutputItem::with('StockTransitRawMaterial')->get();
        // return $PrmRawMOI;
        return response()->view('purchasing_exim.StockTransitRawMaterial.index', [
            'stockTGK' => $stockTGK,
            'PrmRawMOI' => $PrmRawMOI,
            'i' => $i,
        ]);
    }
}
