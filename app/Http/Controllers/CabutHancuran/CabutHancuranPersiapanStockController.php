<?php

namespace App\Http\Controllers\CabutHancuran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CabutHancuranPersiapanStock;

class CabutHancuranPersiapanStockController extends Controller
{
    // index
    public function index()
    {
        $CabutHancuranPersiapanStock = CabutHancuranPersiapanStock::all();
        return response()->view('CabutHancuran.CabutHancuranPersiapanStock.index', [
            'cabut_hancuran_persiapan_stocks' => $CabutHancuranPersiapanStock,
        ]);
    }
}
