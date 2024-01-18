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
    protected $GradingKasarHasilService;
    protected $HppService;

    public function __construct(GradingKasarHasilService $GradingKasarHasilService, HppService $HppService)
    {
        $this->GradingKasarHasilService = $GradingKasarHasilService;
        $this->HppService = $HppService;
    }
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

    ) {
        $dataArray = json_decode($request->input('data'));
        $dataColl = collect($dataArray);
        $berats = array();
        $harga_estimasi = array();
        $totalModal = array();
        // return $dataColl;
        foreach ($dataColl as $key => $value) {
            $berats[] = $value->berat;
            $harga_estimasi[] = $value->harga_estimasi;
            $totalModal[] = $value->total_modal;
        };
        $dataHpp = 'dataHPPService';
        //panggil service

        $result = $GradingKasarHasilService->simpanData($dataArray); //ngambil array id dari data yang diinput
        $dataHpp = $this->HppService->calculate($berats, $harga_estimasi, $totalModal);
        // return $result;

        $arrayIds = $result['data'];
        foreach ($arrayIds as $key => $value) {
            // return $key;
            $data = GradingKasarHasil::where('id', $value)->update([
                'nilai_laba_rugi'                       => $dataHpp[$key]['nilai_laba_rugi'],
                'nilai_prosentase_total_keuntungan'     => $dataHpp[$key]['nilai_prosentase_total_keuntungan'],
                'nilai_dikurangi_keuntungan'            => $dataHpp[$key]['nilai_setelah_dikurangi_keuntungan'],
                'prosentase_harga_gramasi'              => $dataHpp[$key]['prosentase_harga_gramasi'],
                'selisih_laba_rugi_kg'                  => $dataHpp[$key]['selisih_laba_rugi_kg'],
                'selisih_laba_rugi_gram'                => $dataHpp[$key]['selisih_laba_rugi_gram'],
                'hpp'                                   => $dataHpp[$key]['hpp'],
                'total_hpp'                             => $dataHpp[$key]['total_hpp'],
            ]);
        }
        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }

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
