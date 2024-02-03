<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Models\PreGradingHalusInput;
use App\Http\Controllers\Controller;
use App\Models\TransitPreCleaningStock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PreGradingHalusInputController extends Controller
{
    //
    public function index(){
        $i =1;
        $PreGHI = PreGradingHalusInput::with('TransitPreCleaningStock')->get();

        // return $GradingKI;
        return response()->view('PreGradingHalus.PreGradingHalusInput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create(): View
    {
        $PreGHI = PreGradingHalusInput::with('TransitPreCleaningStock')->get();
        $TransitPre = TransitPreCleaningStock::with('PreGradingHalusInput')->get();
        // return $PrmRawMOIC;
        return view('PreGradingHalus.PreGradingHalusInput.create', compact('PreGHI', 'TransitPre'));
    }
}
