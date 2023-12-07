<?php

namespace App\Http\Controllers;

use App\Models\unit;
use App\Models\Workstation;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){

        $workstation = Workstation::get();
        $unit = unit::all();
        return response()->view('Unit', [
            'unit' => $unit,
            'workstation' => $workstation,
        ]);

    }
}
