<?php

namespace App\Http\Controllers\PreWash;

use App\Http\Controllers\Controller;
use App\Models\PreWashStock;
use Illuminate\Http\Request;

class PreWashStockController extends Controller
{
    //
    public function index()
    {
        $i = 1;
        $PreWashStock = PreWashStock::all();
        return response()->view('PreWash.PreWashStock.index', [
            'pre_wash_stocks' => $PreWashStock,
            'i' => $i,
        ]);
    }
}
