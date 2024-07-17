<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\TransitCabutBulu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransitCabutBuluController extends Controller
{
    //Index
    public function index()
    {
        $i = 1;
        $TransitPreCleaningStock = TransitCabutBulu::with('CabutBuluPengembalian')->where('status',1);
        // return $PrmRawMOI;
        if(Auth::user()->plant){
            $TransitPreCleaningStock->where('tujuan_kirim',Auth::user()->plant);
        }
        $TransitPreCleaningStock=$TransitPreCleaningStock->latest()->get();
        return response()->view('CabutBulu.CabutBuluTransit.index', [
            'transit_pre_cleaning_stocks' => $TransitPreCleaningStock,
            'i' => $i,
        ]);
    }
}
