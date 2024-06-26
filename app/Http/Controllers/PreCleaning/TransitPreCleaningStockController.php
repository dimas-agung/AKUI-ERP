<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Models\PreCleaningOutput;
use App\Models\TransitPreCleaningStock;
use Illuminate\Http\Request;

class TransitPreCleaningStockController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitPreCleaningStock::where('berat_kirim', '>', 0)->get();
        // return $PrmRawMOI;
        return response()->view('PreCleaning.TransitPreCLeaningStock.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
