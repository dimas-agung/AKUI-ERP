<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\TransitMoulding;
use App\Http\Controllers\Controller;

class TransitMouldingController extends Controller
{
    //index
    public function index()
    {
        $TransitMoulding = TransitMoulding::where('status', 1)->get();
        return response()->view('Moulding.TransitMoulding.index', [
            'transit_moulding' => $TransitMoulding
        ]);
    }
}
