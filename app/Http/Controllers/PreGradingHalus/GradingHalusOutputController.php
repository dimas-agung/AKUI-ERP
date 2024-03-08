<?php

namespace App\Http\Controllers\PreGradingHalus;


use App\Models\GradingHalusOutput;
use App\Models\GradingHalusStock;
use App\Models\TransitPreCleaningStock;
use App\Models\MasterJenisGradingHalus;
use App\Services\GradingHalusInputService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class GradingHalusOutputController extends Controller
{
    public function index(){
        $i =1;
        $PreGHI = GradingHalusOutput::with('GradingHalusStock')->get();
        $TransitPre = GradingHalusStock::with('GradingHalusOutput')->get();
        // return $GradingKI;

        return response()->view('PreGradingHalus.GradingHalusOutput.index', [
            'PreGHI' => $PreGHI,
            'TransitPre' => $TransitPre,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $PreGHI = GradingHalusOutput::with('PreGradingHalusAddingStock')->get();
        $TransitPre = GradingHalusStock::with('GradingHalusOutput')->get();
        // return $TransitPre;
        return view('PreGradingHalus.GradingHalusOutput.create', compact('PreGHI', 'TransitPre'));
    }
}
