<?php

namespace App\Http\Controllers\GradingWarna;

use App\Http\Controllers\Controller;
use App\Models\GradingWarnaPenerimaanStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradingWarnaPenerimaanStockController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $GradigHalusStock = GradingWarnaPenerimaanStock::where('tujuan_kirim',Auth::user()->plant)->where('status',1)->get();
        // return $GradigHalusStock;
        return response()->view('GradingWarna.GradingWarnaPenerimaanStock.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
