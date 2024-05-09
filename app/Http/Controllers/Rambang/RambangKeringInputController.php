<?php

namespace App\Http\Controllers\Rambang;

use Illuminate\Http\Request;
use App\Models\RambangKeringInput;
use App\Http\Controllers\Controller;

class RambangKeringInputController extends Controller
{

    // index
    public function index()
    {
        $i = 1;
        $RambangKeringInput = RambangKeringInput::all();
        return response()->view('Rambang.RambangKeringInput.index', [
            'rambang_kering_input' => $RambangKeringInput,
            'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $RambangKeringInput = RambangKeringInput::all();
        $RambangKeringInput = RambangKeringInput::with('RambangBasahStock')->get();
        return response()->view('Rambang.RambangKeringInput.create', [
            'rambang_kering_input' => $RambangKeringInput,
        ]);
    }
}
