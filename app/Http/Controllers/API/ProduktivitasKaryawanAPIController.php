<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluPengembalian;
use App\Models\CabutHancuranPengembalian;
use Illuminate\Http\Request;

class ProduktivitasKaryawanAPIController extends Controller
{
    //
    public function getDataCleaning(Request $request){
        $i = 1;
      
        $startDate = $request->input('start_date') ?? date('Y-m-d');
        $endDate = $request->input('end_date') ?? date('Y-m-d');

        $query = CabutBuluPengembalian::query();
        

        if ($startDate && $endDate) {
            $query->whereBetween(CabutBuluPengembalian::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $cabut_bulu_stock = $query

            ->get();
        }else{
            $cabut_bulu_stock = [];
        }
        if (empty($cabut_bulu_stock)) {
            return response()->json(['message' => 'data tidak tersedia'], 201)
        ->header('Access-Control-Allow-Origin', '*');
        }
        $response = ['status' => 'success' , 'data' => $cabut_bulu_stock];
        return response()->json($response, 200)
        ->header('Access-Control-Allow-Origin', '*');
    }
    public function getDataCleaningHancuran(Request $request){
        $i = 1;
        $startDate = $request->input('start_date') ?? date('Y-m-d');
        $endDate = $request->input('end_date') ?? date('Y-m-d');

        $query = CabutHancuranPengembalian::with('CabutBuluStock');
        

        if ($startDate && $endDate) {
            $query->whereBetween(CabutHancuranPengembalian::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $cabut_bulu_stock = $query
            ->get();
        }else{
            $cabut_bulu_stock = [];
        }
        return response()->json(['status' => 'success' , 'data' => $cabut_bulu_stock], 200)
        ->header('Access-Control-Allow-Origin', '*');
    }
}
