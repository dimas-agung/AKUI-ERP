<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabutBuluStockController extends Controller
{

    public function index(){
        $i =1;
        $cabut_bulu_stock = CabutBuluStock::where('status','!=',CabutBuluStock::STATUS_FINISHED);
        if(Auth::user()->plant){
            $cabut_bulu_stock->where('tujuan_kirim',Auth::user()->plant);
        }
        $cabut_bulu_stock = $cabut_bulu_stock->latest()->get();
        return response()->view('CabutBulu.CabutBuluStock.index', [
            'cabut_bulu_stock' => $cabut_bulu_stock,
        ]);
    }
}
