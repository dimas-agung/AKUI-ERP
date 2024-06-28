<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PreCleaningStock;

class PreCleaningStockController extends Controller
{
    //
    public function index()
    {
        $i = 1;
        $PCStock = PreCleaningStock::where('sisa_berat','>',0)->get();
        // $PCStock = PreCleaningStock::get();
        // return ($PCStock);
        return response()->view('PreCleaning.PreCleaningStock.index', [
            'PCStock'       => $PCStock,
            'i'             => $i
        ]);
    }
}
