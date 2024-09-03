<?php

namespace App\Http\Controllers\MouldingRework;

use App\Http\Controllers\Controller;
use App\Models\TransitFinalGradingRework;
use App\Models\TransitMouldingRework;
use Illuminate\Http\Request;

class TransitMouldingReworkController extends Controller
{
    //Index
    public function index ()
    {
        $i = 1;
        $TransitMouldingRework = TransitMouldingRework::where('status',1)->get();
        // return $PrmRawMOI;
        return response()->view('MouldingRework.TransitMouldingRework.index', [
            'transit_moulding_rework' => $TransitMouldingRework,
            'i' => $i,
        ]);
    }
}
