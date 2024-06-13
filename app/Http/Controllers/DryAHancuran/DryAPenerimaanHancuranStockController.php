<?php

namespace App\Http\Controllers\DryAHancuran;

use App\Http\Controllers\Controller;
use App\Models\DryAPenerimaanHancuranStock;
use Illuminate\Http\Request;

class DryAPenerimaanHancuranStockController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $GradigHalusStock = DryAPenerimaanHancuranStock::all();
        // return $GradigHalusStock;
        return response()->view('DryAHancuran.DryAPenerimaanStock.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
