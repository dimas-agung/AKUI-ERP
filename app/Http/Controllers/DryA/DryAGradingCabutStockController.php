<?php

namespace App\Http\Controllers\DryA;

use App\Http\Controllers\Controller;
use App\Models\DryAGradingCabutStock;
use App\Models\DryAPenerimaanCabutStock;
use Illuminate\Http\Request;

class DryAGradingCabutStockController extends Controller
{
    //index
    public function index()
    {
        $DryAGradingCabutStock = DryAGradingCabutStock::where('status',1)->get();
        return response()->view('DryA.DryAGradingCabutStock.index', [
            'dry_a_grading_cabut_stock' => $DryAGradingCabutStock,
        ]);
    }
}
