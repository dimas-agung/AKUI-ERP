<?php

namespace App\Http\Controllers;

use App\Models\MasterJenis;
use Illuminate\Http\Request;

class MasterJenisController extends Controller
{
    //
    public function index()
    {

        $MasterJenis = MasterJenis::all();

        return response()->view('beranda.MasterJenis', [
            'MasterJenis' => $MasterJenis,
        ]);
    }
}
