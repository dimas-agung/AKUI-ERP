<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialStock;
use Illuminate\Http\Request;

class PrmRawMaterialStockController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PrmRawMaterialStock = PrmRawMaterialStock::all();
        return response()->view('purchasing_exim.prm_raw_material_stock.index', [
            'PrmRawMaterialStock' => $PrmRawMaterialStock,
            'i' => $i
        ]);
    }

}
