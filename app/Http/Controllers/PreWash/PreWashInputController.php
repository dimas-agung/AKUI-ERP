<?php

namespace App\Http\Controllers\PreWash;

use App\Models\PreWashInput;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreWashInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreWashInput = PreWashInput::all();
        return response()->view('PreWash.PreWashInput.index', [
            'pre_wash_inputs' => $PreWashInput,
            'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $PreWashInput = PreWashInput::with('StockTransitGrading')->get();
        return response()->view('PreWash.PreWashInput.create', compact('PreWashInput'));
    }
}
