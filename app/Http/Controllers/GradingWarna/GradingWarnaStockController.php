<?php

namespace App\Http\Controllers\GradingWarna;

use Illuminate\Http\Request;
use App\Models\GradingWarnaStock;
use App\Http\Controllers\Controller;

class GradingWarnaStockController extends Controller
{
    //index
    public function index()
    {
        $GradingWarnaStock = GradingWarnaStock::where('sisa_berat', '!=', 0)->get();
        return response()->view('GradingWarna.GradingWarnaStock.index', [
            'grading_warna_stock' => $GradingWarnaStock
        ]);
    }
}
