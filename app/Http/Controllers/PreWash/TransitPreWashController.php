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
        $transitprewash = TransitPreWash::all();
        return response()->view('PreWash.TransitPreWash.index', [
            'transitprewash'          => $transitprewash,
            'i'                             => $i
        ]);
    }
}
