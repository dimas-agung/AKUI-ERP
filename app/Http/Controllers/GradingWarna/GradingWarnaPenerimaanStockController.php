<?php

namespace App\Http\Controllers\GradingWarna;

use App\Http\Controllers\Controller;
use App\Models\GradingWarnaPenerimaanStock;
use Illuminate\Http\Request;

class GradingWarnaPenerimaanStockController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $GradigHalusStock = GradingWarnaPenerimaanStock::all();
        // return $GradigHalusStock;
        return response()->view('GradingWarna.GradingWarnaPenerimaanStock.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
