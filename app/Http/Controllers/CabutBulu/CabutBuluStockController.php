<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluStock;
use Illuminate\Http\Request;

class CabutBuluStockController extends Controller
{
    public function index(){
        $i =1;
        $CBPenerimaan = CabutBuluStock::get();


        return response()->view('CabutBulu.CabutBuluStock.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
