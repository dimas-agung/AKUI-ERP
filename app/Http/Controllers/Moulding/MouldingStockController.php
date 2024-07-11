<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\MouldingStock;
use App\Http\Controllers\Controller;

class MouldingStockController extends Controller
{
    //index
    public function index()
    {
        $MouldingStock = MouldingStock::all();
        return response()->view('Moulding.MouldingStock.index', [
            'moulding_stock' => $MouldingStock
        ]);
    }
}
