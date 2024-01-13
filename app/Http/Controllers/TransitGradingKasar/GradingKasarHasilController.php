<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarHasil;
use App\Models\GradingKasarInput;
use App\Models\MasterJenisGradingKasar;

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
        $GradingKasarInput = GradingKasarInput::with('GradingKasarHasil')->get();
        $MasterJenisGradingKasar = MasterJenisGradingKasar::with('GradingKasarHasil')->get();
        // $GradingKasarHasil = GradingKasarHasil::with('PrmRawMaterialInput')->get();
        // $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        // return view('grading_kasar_hasil.create', [
        //     'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
        //     'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
        // ]);
        // return view('purchasing_exim.PrmRawMaterialOutput.create', compact('PrmRawMOIC', 'PrmRawMS', 'MasTujKir'));
        return view('transit_grading.GradingKasarHasil.create', compact('GradingKasarInput', 'MasterJenisGradingKasar'));
    }
    // set
    public function set(Request $request)
    {
        $nomor_grading = $request->nomor_grading;
        // Lakukan logika untuk mengatur nomor batch berdasarkan id_box
        $data = GradingKasarInput::where('nomor_grading', $nomor_grading)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
}
