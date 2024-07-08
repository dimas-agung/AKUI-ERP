<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;

use App\Models\RambangBasahStock;
use Illuminate\Http\Request;

class RambangBasahStockController extends Controller
{
    //Index
    public function index(Request $request){
        $i =1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = RambangBasahStock::query();


        if ($startDate && $endDate) {
            $query->whereBetween(RambangBasahStock::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $CBPenerimaan = $query->get();
        }else{
            $CBPenerimaan = RambangBasahStock::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('Rambang.RambangBasahStock.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
