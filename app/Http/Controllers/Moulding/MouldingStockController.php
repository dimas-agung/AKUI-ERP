<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\MouldingStock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MouldingStockController extends Controller
{
    //index
    public function index()
    {
        $MouldingStock = MouldingStock::where(['tujuan_kirim' => Auth::user()->plant])->where('status', '!=', 3)->get();
        return response()->view('Moulding.MouldingStock.index', [
            'moulding_stock' => $MouldingStock
        ]);
    }
}
