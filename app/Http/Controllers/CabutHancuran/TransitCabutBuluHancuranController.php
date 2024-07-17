<?php

namespace App\Http\Controllers\CabutHancuran;

use App\Http\Controllers\Controller;
use App\Models\TransitCabutBuluHancuran;
use Illuminate\Http\Request;

class TransitCabutBuluHancuranController extends Controller
{
    // index
    public function index()
    {
        $TransitCabutBuluHancuran = TransitCabutBuluHancuran::where('status',1)->get();
        return response()->view('CabutHancuran.TransitCabutBuluHancuran.index', [
            'transit_cabut_bulu_hancuran' => $TransitCabutBuluHancuran,
        ]);
    }
}
