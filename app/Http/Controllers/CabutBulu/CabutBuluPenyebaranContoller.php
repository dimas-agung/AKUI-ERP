<?php

namespace App\Http\Controllers\CabutBulu;

use Illuminate\Http\Request;
use App\Models\CabutBuluStock;
use App\Models\CabutBuluPenyebaran;
use App\Http\Controllers\Controller;
use App\Models\MasterOperator;

class CabutBuluPenyebaranContoller extends Controller
{
    // index
    public function index()
    {
        $i = 1;
        $CabutBuluPenyebaran = CabutBuluPenyebaran::all();
        return response()->view('CabutBulu.CabutBuluPenyebaran.index', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
            'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $MasterOperator = MasterOperator::all();
        $CabutBuluPenyebaran = CabutBuluPenyebaran::all();
        $CabutBuluStock = CabutBuluStock::all();
        return view('CabutBulu.CabutBuluPenyebaran.create', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
            'master_operators' => $MasterOperator,
            'cabut_bulu_stocks' => $CabutBuluStock,
        ]);
    }

    //set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = CabutBuluStock::where('nomor_job', $nomor_job)
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }
    public function setNip(Request $request)
    {
        $nip = $request->nip;
        $data = CabutBuluStock::where('nip', $nip)
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }
}
