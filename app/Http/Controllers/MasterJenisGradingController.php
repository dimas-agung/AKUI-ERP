<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisGrading;
use App\Models\Unit;
use Illuminate\Http\Request;

class MasterJenisGradingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterJenisGrading = MasterJenisGrading::with('Unit')->get();
        $Unit = Unit::with('Unit')->get();
        return response()->view('master.master_jenis_grading.index', [
            'MasterJenisGrading'    => $MasterJenisGrading,
            'Unit'                  => $Unit,
            'i'                     => $i
        ]);
    }
}
