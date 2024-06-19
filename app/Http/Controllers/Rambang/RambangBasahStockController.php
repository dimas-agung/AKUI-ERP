<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;

use App\Models\RambangBasahStock;
use Illuminate\Http\Request;

class RambangBasahStockController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = RambangBasahStock::get();

        return response()->view('Rambang.RambangBasahStock.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
