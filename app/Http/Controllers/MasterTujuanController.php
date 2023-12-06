<?php

namespace App\Http\Controllers;

use App\Models\MasterJenis;
use Illuminate\Http\Request;

class MasterTujuanController extends Controller
{
    //
    public function index()
    {

        $MasterTujuan = MasterJenis::all();

        return response()->view('beranda.MasterTujuan', [
            'MasterSupplier' => $MasterTujuan,
        ]);
    }
}
