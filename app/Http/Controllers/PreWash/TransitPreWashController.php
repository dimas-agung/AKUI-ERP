<?php

namespace App\Http\Controllers\PreWash;

use App\Http\Controllers\Controller;
use App\Models\TransitPreWash;
use Illuminate\Http\Request;

class TransitPreWashController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $transitprewash = TransitPreWash::with('PreWashOutput')->get();
        return response()->view('PreWash.TransitPreWash.index', [
            'transitprewash'          => $transitprewash,
            'i'                             => $i
        ]);
    }
}
