<?php

namespace App\Http\Controllers\CabutHancuran;

use App\Http\Controllers\Controller;
use App\Models\CabutHancuranPersiapanStock;
use Illuminate\Http\Request;

class CabutHancuranPersiapanStockController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = CabutHancuranPersiapanStock::get();


        return response()->view('CabutHancuran.CabutHancuranPersiapanStock.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
