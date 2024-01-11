<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarHasil;
use App\Models\MasterJenisGradingKasar;
use App\Models\MasterJenisRawMaterial;
use App\Models\MasterSupplierRawMaterial;
use Illuminate\Http\Request;

class GradingKasarHasilController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        // $MasterJenisGradingHasil = MasterJenisGradingKasar::with('GradingKasarHasil')->get();
        $GradingKasarHasil = GradingKasarHasil::all();
        // return $MasterJenisGradingHasil;
        // return $GradingKasarHasil;
        return response()->view('transit_grading.GradingKasarHasil.index', [
            // 'master_jenis_grading_hasils'   => $MasterJenisGradingHasil,
            'grading_kasar_hasils'          => $GradingKasarHasil,
            'i'                             => $i
        ]);
    }

    // create
    public function create()
    {
        // $GradingKasarHasil = GradingKasarHasil::with('PrmRawMaterialInput')->get();
        // $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        // return view('grading_kasar_hasil.create', [
        //     'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
        //     'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
        // ]);
        return view('transit_grading.GradingKasarHasil.create');
    }
}
