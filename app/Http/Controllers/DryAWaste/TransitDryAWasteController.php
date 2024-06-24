<?php

namespace App\Http\Controllers\DryAWaste;

use App\Http\Controllers\Controller;
use App\Models\TransitDryAWaste;
use Illuminate\Http\Request;

class TransitDryAWasteController extends Controller
{
    public function index ()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitDryAWaste::with('PreCleaningOutput')->get();
        // return $PrmRawMOI;
        return response()->view('DryAWaste.TransitDryAWaste.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
