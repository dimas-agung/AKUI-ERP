<?php

namespace App\Http\Controllers\Rambang;

use Illuminate\Http\Request;
use App\Models\RambangKeringStock;
use App\Http\Controllers\Controller;

class RambangKeringStockController extends Controller
{
    // index
    public function index()
    {
        $RambangKeringStock = RambangKeringStock::all();
        return response()->view('Rambang.RambangKeringStock.index', [
            'rambang_kering_stock' => $RambangKeringStock,
        ]);
    }
}
