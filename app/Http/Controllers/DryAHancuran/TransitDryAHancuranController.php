<?php

namespace App\Http\Controllers\DryAHancuran;

use App\Http\Controllers\Controller;
use App\Models\TransitDryAHancuran;
use Illuminate\Http\Request;

class TransitDryAHancuranController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitDryAHancuran::get();
        // return $PrmRawMOI;
        return response()->view('DryAHancuran.TransitDryA.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
