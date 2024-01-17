<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarHasil;
use App\Models\GradingKasarInput;
use App\Models\MasterJenisGradingKasar;
use App\Services\GradingKasarHasilService;
use App\Services\HppService;
use App\Http\Requests\GradingKasarHasilRequest;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class GradingKasarHasilController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        // $MasterJenisGradingHasil = MasterJenisGradingKasar::with('GradingKasarHasil')->get();
        $GradingKasarHasil = GradingKasarHasil::all();
        // $MasterJenisGradingKasarHasil = GradingKasarHasil::all();
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

        return view('transit_grading.GradingKasarHasil.create', compact('GradingKasarInput', 'MasterJenisGradingKasar'));
    }

    // set
    public function set(Request $request)
    {
        $nomor_grading = $request->nomor_grading;
        // $harga_estimasi = $request->harga_estimasi;
        // Lakukan logika untuk mengatur nomor batch berdasarkan id_box
        $data = GradingKasarInput::where('nomor_grading', $nomor_grading)->first();
        // $data_harga = MasterJenisGradingKasar::where('harga_estimasi', $harga_estimasi)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    // simpanData
    public function simpanData(
        GradingKasarHasilRequest $request,
        GradingKasarHasilService $GradingKasarHasilService,

    )
    // public function simpanData(Request $request)
    {
        $dataArray = json_decode($request->input('data'));

        $result = $GradingKasarHasilService->simpanData($dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }
    // simpanData
    // public function simpanData2(
    //     GradingKasarHasilRequest $request,
    //     GradingKasarHasilService $GradingKasarHasilService,

    // )
    // // public function simpanData(Request $request)
    // {
    //     $dataArray = json_decode($request->input('data'));

    //     $result = $GradingKasarHasilService->simpanData2($dataArray2);

    //     if ($result['success']) {
    //         return response()->json($result);
    //     } else {
    //         return response()->json($result, 500);
    //     }
    // }
    // show
    // public function show(string $id)
    // {
    //     $i = 1;
    //     // $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
    //     // $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
    //     //get by ID
    //     $MasterGKH = PrmRawMaterialInput::findOrFail($id);
    //     $MasterPRIM = PrmRawMaterialInput::with('PrmRawMaterialInputItem')
    //         ->where(['id' => $id])
    //         ->first();


    //     return response()->view('purchasing_exim.prm_raw_material_input.show', compact('MasterPRIM', 'i'));
    // }
    // destroy
    public function destroyInput($id): RedirectResponse
    {
        //get by ID
        $GradingKasarHasil = GradingKasarHasil::findOrFail($id);

        //delete
        $GradingKasarHasil->delete();

        //redirect to index
        return redirect()->route('grading_kasar_hasil.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
