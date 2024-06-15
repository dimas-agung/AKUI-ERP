<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\HcrKotorStock;
use Illuminate\Http\Request;

class StockHcrKotorController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = HcrKotorStock::get();

        return response()->view('Rambang.StockHcrKotor.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
