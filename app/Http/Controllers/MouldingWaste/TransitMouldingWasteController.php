<?php

namespace App\Http\Controllers\MouldingWaste;

use App\Http\Controllers\Controller;
use App\Models\TransitMouldingWaste;
use Illuminate\Http\Request;

class TransitMouldingWasteController extends Controller
{
    //Index
    public function index ()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitMouldingWaste::all();
        // return $PrmRawMOI;
        return response()->view('MouldingWaste.TransitMouldingWaste.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
