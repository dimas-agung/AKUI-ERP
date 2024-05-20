<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\TransitRambangWaste;
use Illuminate\Http\Request;

class TransitRambangWasteController extends Controller
{
    // index
    public function index()
    {
        $TransitRambangWaste = TransitRambangWaste::all();
        return response()->view('Rambang.TransitRambangWaste.index', [
            'transit_rambang_waste' => $TransitRambangWaste,
        ]);
    }
}
