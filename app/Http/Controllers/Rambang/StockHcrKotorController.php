<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\StockHcrKotor;
use Illuminate\Http\Request;

class StockHcrKotorController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = StockHcrKotor::get();

        return response()->view('Rambang.StockHcrKotor.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
