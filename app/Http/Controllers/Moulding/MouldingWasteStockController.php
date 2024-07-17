<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\MouldingWasteStock;
use App\Http\Controllers\Controller;

class MouldingWasteStockController extends Controller
{
    //index
    public function index()
    {
        $user = auth()->user()->plant;
        // return $user;
        $MouldingWasteStock = MouldingWasteStock::where('plant', '=', $user)
            ->where('status', MouldingWasteStock::STATUS_AKTIF)
            ->get();
        // return $MouldingWasteStock;
        return response()->view('Moulding.MouldingWasteStock.index', [
            'moulding_waste_stock' => $MouldingWasteStock,
        ]);
    }
}
