<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
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
    // show history
    public function show(string $id)
    {
        // tes
        $i = 1;
        // $PrmRawMaterialStockHistory = PrmRawMaterialStockHistory::with('PrmRawMaterialStock')
        //     ->where(['id' => $id])
        //     ->first();
        //get by ID
        $PrmRawMaterialStockHistory = PrmRawMaterialStockHistory::findOrFail($id);

        //render view
        return view('purchasing_exim.prm_raw_material_stock_history.show', compact('PrmRawMaterialStockHistory'));
        // return response()->view('prm_raw_material_stock_history.show', [
        //     'PrmRawMaterialStockHistory' => $PrmRawMaterialStockHistory,
        //     'i' => $i
        // ]);
    }
}
