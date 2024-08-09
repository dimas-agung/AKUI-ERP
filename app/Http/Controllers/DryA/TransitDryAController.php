<?php

namespace App\Http\Controllers\DryA;

use App\Http\Controllers\Controller;
use App\Models\TransitDryACabut;
use Illuminate\Http\Request;

class TransitDryAController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitDryACabut::where('status',1)->get();
        // return $PrmRawMOI;
        return response()->view('DryA.TransitDryA.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
