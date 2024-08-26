<?php

namespace App\Http\Controllers\Kedatangan;

use Illuminate\Http\Request;
use App\Models\TransitKedatangan;
use App\Http\Controllers\Controller;

class TransitKedatanganController extends Controller
{
    //index
    public function index()
    {
        $TransitKedatangan = TransitKedatangan::where('status', TransitKedatangan::STATUS_AKTIF)->get();
        return response()->view('Kedatangan.TransitKedatangan.index', [
            'transit_kedatangan' => $TransitKedatangan
        ]);
    }
}
