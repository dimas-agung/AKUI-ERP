<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterJenisRawMaterial;
use Illuminate\Http\RedirectResponse;

class PrmRawMaterialInput extends Controller
{
    //index
    public function index()
    {
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('prm_raw_material_input')->get();
        $PrmRawMaterialInput = PrmRawMaterialInput::all();
        return response()->view('purchasingexim.prm_raw_material_input.index', [
            'prm_raw_material_input' => $PrmRawMaterialInput,
            'master_jenis_raw_material' => $MasterJenisRawMaterial,
        ]);
    }
}
