<?php

namespace App\Http\Controllers\FinalGrading;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransitFinalGradingRework;

class TransitFinalGradingReworkController extends Controller
{
    //
    public function index()
    {
        $TransitFinalGradingRework = TransitFinalGradingRework::where('status', TransitFinalGradingRework::STATUS_AKTIF)->get();
        return response()->view('FinalGrading.TransitFinalGradingRework.index', [
            'transit_final_grading_rework' => $TransitFinalGradingRework
        ]);
    }
}
