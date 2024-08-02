<?php

namespace App\Http\Controllers\DryA;

use App\Http\Controllers\Controller;
use App\Models\DryAPenerimaanCabutStock;
use App\Models\GradingHalusStock;
use Illuminate\Http\Request;

class DryAPenerimaanStockController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $GradigHalusStock = DryAPenerimaanCabutStock::where('status','!=',0)->get();
        // return $GradigHalusStock;
        return response()->view('DryA.DryAPenerimaanStock.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
