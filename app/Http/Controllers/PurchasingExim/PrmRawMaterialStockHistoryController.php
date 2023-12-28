<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrmRawMaterialStockHistory;

class PrmRawMaterialStockHistoryController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PrmRawMaterialStockHistory = PrmRawMaterialStockHistory::all();
        return response()->view('purchasing_exim.prm_raw_material_stock.index', [
            'PrmRawMaterialStockHistory' => $PrmRawMaterialStockHistory,
            'i' => $i
        ]);
    }
}
