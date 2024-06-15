<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluStock;
use Illuminate\Http\Request;

class CabutBuluStockController extends Controller
{

    public function index(){
        $i =1;
        $cabut_bulu_stock = CabutBuluStock::where('status','!=',CabutBuluStock::STATUS_FINISHED)->get();

        return response()->view('CabutBulu.CabutBuluStock.index', [
            'cabut_bulu_stock' => $cabut_bulu_stock,
        ]);
    }
}
