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
        $PCStock = PreCleaningStock::all();
        // dd($PCStock);
        return response()->view('pre_cleaning.pre_cleaning_stock.index', [
            'PCStock'       => $PCStock,
            'i'             => $i
        ]);
    }
}
