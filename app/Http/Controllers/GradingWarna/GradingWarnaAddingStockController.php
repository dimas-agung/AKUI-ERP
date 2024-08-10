<?php

namespace App\Http\Controllers\GradingWarna;

use App\Http\Controllers\Controller;
use App\Models\GradingWarnaAdding;
use App\Models\GradingWarnaAddingStock;
use Illuminate\Http\Request;

class GradingWarnaAddingStockController extends Controller
{
    //index
    public function index()
    {
        $GradingWarnaAddingStock = GradingWarnaAddingStock::where('status', 1)->get();
        return response()->view('GradingWarna.GradingWarnaAddingStock.index', [
            'grading_warna_adding_stock' => $GradingWarnaAddingStock
        ]);
    }
}
