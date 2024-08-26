<?php

namespace App\Http\Controllers\MouldingRework;

use App\Http\Controllers\Controller;
use App\Models\MouldingPersiapanReworkStock;
use Illuminate\Http\Request;

class MouldingPersiapanReworkStockController extends Controller
{
    //
    public function index()
    {
        $i = 1;
        $plant = auth()->user()->plant; // Ambil input plant dari user
        $MouldingPRS = MouldingPersiapanReworkStock::where('status','>',0)
            ->where('tujuan_kirim',  $plant)
            ->get();
        // $MouldingPRS = PreCleaningStock::get();
        // return ($MouldingPRS);
        return response()->view('MouldingRework.MouldingPersiapanReworkStock.index', [
            'MouldingPRS'       => $MouldingPRS,
            'i'             => $i
        ]);
    }
}
