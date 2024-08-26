<?php

namespace App\Http\Controllers\Produktivitas;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluPengembalian;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduktivitasCabutBuluController extends Controller
{

    public function index(Request $request){
        $i = 1;
        // $PreWashInput = PreWashInput::all();
        $plant = $request->input('plant');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = CabutBuluPengembalian::with('CabutBuluStock');
        

        if ($startDate && $endDate) {
            $query->whereBetween(CabutBuluPengembalian::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $cabut_bulu_stock = $query
            ->where('tujuan_kirim',$plant)
            ->get();
        }else{
            $cabut_bulu_stock = [];
        }
        $dataPlant = Perusahaan::where('status',1)->get();
        // return $cabut_bulu_stock;
        return response()->view('Produktivitas.CabutBulu.index', [
            'cabut_bulu_stock' => $cabut_bulu_stock,
            'data_plant' => $dataPlant
        ]);
    }
}
