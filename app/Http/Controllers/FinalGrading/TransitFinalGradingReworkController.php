<?php

namespace App\Http\Controllers\FinalGrading;

use App\Http\Controllers\Controller;
use App\Models\TransitFinalGradingRework;
use Illuminate\Http\Request;

class TransitFinalGradingReworkController extends Controller
{
    //
    public function index()
    {
        $i = 1;
        $TransitFGR = TransitFinalGradingRework::where('status','>',0)->get();
        // $TransitFGR = PreCleaningStock::get();
        // return ($TransitFGR);
        return response()->view('FinalGrading.TransitFinalGradingRework.index', [
            'TransitFGR'       => $TransitFGR,
            'i'             => $i
        ]);
    }
}
