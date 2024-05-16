<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;

use App\Models\StockRambangBasah;
use Illuminate\Http\Request;

class StockRambangBasahController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = StockRambangBasah::get();

        return response()->view('Rambang.StockRambangBasah.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
