<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterSupplier;
use Illuminate\View\View;

class MasterSupplierController extends Controller
{
    //
    public function index()
    {

        $MasterSupplier = MasterSupplier::all();

        return response()->view('beranda.MasterSupplier', [
            'MasterSupplier' => $MasterSupplier,
        ]);
    }
}
