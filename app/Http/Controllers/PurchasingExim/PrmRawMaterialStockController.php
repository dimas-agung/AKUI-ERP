<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\PrmRawMaterialStock;
use Illuminate\Http\Request;

class PrmRawMaterialStockController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PrmRawMaterialInput = PrmRawMaterialInputItem::with('PrmRawMaterialStock')->get();
        $PrmRawMaterialStock = PrmRawMaterialStock::with('PrmRawMaterialOutputItem')->get();

        // return $PrmRawMaterialInput;
        return response()->view('purchasing_exim.prm_raw_material_stock.index', [
            'PrmRawMaterialStock' => $PrmRawMaterialStock,
            'PrmRawMaterialInput' => $PrmRawMaterialInput,
            'i' => $i
        ]);
    }


        // Show
        public function show(string $id_box)
        {
            $i =1;
            $inputData = PrmRawMaterialInputItem::with('PrmRawMaterialStockHistory')->where('id_box', $id_box)->get();
            $outputData = PrmRawMaterialStock::with('PrmRawMaterialStockHistory')->where('id_box', $id_box)->get();

        // return $inputData;
        // return $outputData;
        // Gabungkan dan susun data berdasarkan waktu
        $stockHistory = $inputData->merge($outputData)->sortBy('id_box')
            ->pluck('PrmRawMaterialStockHistory') // Ambil relasi PrmRawMaterialStockHistory
            ->collapse(); // Gabungkan koleksi hasil pluck menjadi satu
            // $stockHistory = $stockHist->PrmRawMaterialStockHistory;
            // return $stockHistory;

            // Kirim data ke tampilan
            return view('purchasing_exim.PrmRawMaterialStockHistory.index', compact('stockHistory', 'i'));
        }

}
