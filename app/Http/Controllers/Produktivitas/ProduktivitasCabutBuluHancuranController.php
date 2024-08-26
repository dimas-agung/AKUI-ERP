<?php

namespace App\Http\Controllers\Produktivitas;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluPengembalian;
use App\Models\CabutHancuranPengembalian;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduktivitasCabutBuluHancuranController extends Controller
{

    public function index(Request $request){
        $i = 1;
        // $PreWashInput = PreWashInput::all();
        $plant = $request->input('plant') ?? '';
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = CabutHancuranPengembalian::query();
        

        if ($startDate && $endDate) {
            $query->whereBetween(CabutHancuranPengembalian::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $cabut_bulu_stock = $query
            ->where('nomor_job','LIKE','%'.$plant)
            ->get();
        }else{
            $cabut_bulu_stock = [];
        }
        $dataPlant = Perusahaan::where('status',1)->get();
        // return $cabut_bulu_stock;
        return response()->view('Produktivitas.CabutBuluHancuran.index', [
            'cabut_bulu_stock' => $cabut_bulu_stock,
            'data_plant' => $dataPlant,
            'plant_filter' => $plant
        ]);
    }
}
