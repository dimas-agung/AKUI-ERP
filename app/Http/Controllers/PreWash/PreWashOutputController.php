<?php

namespace App\Http\Controllers\PreWash;

use App\Http\Controllers\Controller;
use App\Models\PreWashOutput;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PreWashOutputController extends Controller
{
    public function index()
    {
        $i = 1;
        $PreCleaningOutput = PreWashOutput::all();
        return response()->view('PreWash.PreWashOutput.index', [
            'pre_cleaning_outputs' => $PreCleaningOutput,
            'i' => $i,
        ]);
    }
}
