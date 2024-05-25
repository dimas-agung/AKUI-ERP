<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\TransitGradingHalus;
use Illuminate\Http\Request;

class TransitGradingHalusController extends Controller
{
    //
    public function index()
    {
        $i = 1;
        $GradigHalusStock = TransitGradingHalus::where('status',1)->get();
        return response()->view('PreGradingHalus.TransitGradingHalus.index', [
            'grading_halus_stocks'          => $GradigHalusStock,
            'i'                             => $i
        ]);
    }
}
