<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\InputHcrKotor;
use Illuminate\Http\Request;

class InputHcrKotorController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = InputHcrKotor::get();

        return response()->view('Rambang.InputHcrKotor.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }
}
