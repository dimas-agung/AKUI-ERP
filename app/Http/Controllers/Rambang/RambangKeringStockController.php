<?php

namespace App\Http\Controllers\Rambang;

use Illuminate\Http\Request;
use App\Models\RambangKeringStock;
use App\Http\Controllers\Controller;

class RambangKeringStockController extends Controller
{
    // index
    public function index(Request $request)
    {
        // $RambangKeringStock = RambangKeringStock::all();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = RambangKeringStock::query();
    
    
        if ($startDate && $endDate) {
            $query->whereBetween(RambangKeringStock::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $RambangKeringStock = $query->get();
        }else{
            $RambangKeringStock = RambangKeringStock::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('Rambang.RambangKeringStock.index', [
            'rambang_kering_stock' => $RambangKeringStock,
        ]);
    }
}
