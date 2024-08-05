<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\HcrKotorStock;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class HcrKotorStockController extends Controller
{
    //Index
    public function index(Request $request){
        $i =1;
        // $CBPenerimaan = HcrKotorStock::get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = HcrKotorStock::query();


        if ($startDate && $endDate) {
            $query->whereBetween(HcrKotorStock::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $CBPenerimaan = $query->where('sisa_berat','<>',0)->get();
        }else{
            $CBPenerimaan = HcrKotorStock::limit(1000)
            ->where('sisa_berat','<>',0)
            ->latest()
            ->get();
        }
        return response()->view('Rambang.HcrKotorStock.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
