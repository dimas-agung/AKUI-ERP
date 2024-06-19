<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\HcrKotorStock;
use Illuminate\Http\Request;

class HcrKotorStockController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = HcrKotorStock::get();

        return response()->view('Rambang.HcrKotorStock.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
