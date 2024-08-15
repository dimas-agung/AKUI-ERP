<?php

namespace App\Http\Controllers\FinalGrading;

use Illuminate\Http\Request;
use App\Models\TransitFinalGrading;
use App\Http\Controllers\Controller;

class TransitFinalGradingController extends Controller
{
    //
    public function index()
    {
        $TransitFinalGrading = TransitFinalGrading::where('status', TransitFinalGrading::STATUS_AKTIF)->get();
        return response()->view('FinalGrading.TransitFinalGrading.index', [
            'transit_final_grading' => $TransitFinalGrading
        ]);
    }
}
