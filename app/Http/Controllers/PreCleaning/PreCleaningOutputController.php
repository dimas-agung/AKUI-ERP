<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Models\PreCleaningOutput;
use App\Models\PreCleaningStock;
use Illuminate\Http\Request;

class PreCleaningOutputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreCleaningOutput = PreCleaningOutput::all();
        return response()->view('pre_cleaning.pre_cleaning_output.index', [
            'pre_cleaning_outputs' => $PreCleaningOutput,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreCleaningStock = PreCleaningStock::with('PreCleaningOutput')->get();
        $PreCleaningOutput = PreCleaningOutput::with('PreCleaningStock')->get();
        return view('pre_cleaning.pre_cleaning_output.create', [
            'pre_cleaning_outputs'      => $PreCleaningOutput,
            'pre_cleaning_stocks'       => $PreCleaningStock,
        ]);
    }
    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreCleaningStock::where('nomor_job', $nomor_job)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
}
