<?php

namespace App\Http\Controllers\DryAHancuran;

use App\Http\Controllers\Controller;
use App\Models\DryAGradingHancuranStock;
use Illuminate\Http\Request;

class DryAGradingHancuranStockController extends Controller
{
    //index
    public function index()
    {
        $DryAGradingHancuranStock = DryAGradingHancuranStock::all();
        return response()->view('DryAHancuran.DryAGradingHancuranStock.index', [
            'dry_a_grading_hancuran_stock' => $DryAGradingHancuranStock,
        ]);
    }
}
