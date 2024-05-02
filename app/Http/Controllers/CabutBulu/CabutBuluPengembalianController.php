<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluPengembalian;
use App\Models\CabutBuluStock;
use Illuminate\Http\Request;

class CabutBuluPengembalianController extends Controller
{
    // index
    public function index()
    {
        $i = 1;
        $CabutBuluPenyebaran = CabutBuluPengembalian::all();

        return response()->view('CabutBulu.CabutBuluPengembalian.index', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
            'i' => $i,
        ]);
    }

        // create
        public function create()
        {
            $CabutBuluPenyebaran = CabutBuluPengembalian::all();
            $CabutBuluStock = CabutBuluStock::all();
            // $getUnusedNomorJob = CabutBuluPenyebaran::withCount('CabutBuluStock')->get();
            $getUnusedNomorJob = CabutBuluStock::withCount('CabutBuluPenyebaran')->get();
            // return $getUnusedNomorJob;
            return view('CabutBulu.CabutBuluPengembalian.create', [
                'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
                'cabut_bulu_stocks' => $CabutBuluStock,
                'get_unused_nomor_job' => $getUnusedNomorJob,
            ]);
        }
}
