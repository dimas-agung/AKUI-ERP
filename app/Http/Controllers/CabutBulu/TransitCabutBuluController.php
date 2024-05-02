<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\TransitCabutBulu;
use Illuminate\Http\Request;

class TransitCabutBuluController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitCabutBulu::get();
        // return $PrmRawMOI;
        return response()->view('CabutBulu.CabutBuluTransit.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
