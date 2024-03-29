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
use Illuminate\Support\Facades\DB;

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
        $GradingKasarHasil = GradingKasarHasil::all();
        return response()->view('transit_grading.GradingKasarHasil.index', [
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
        $data = GradingKasarInput::where('nomor_grading', $nomor_grading)->first();
        // return $data;
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
                'total_harga'                           => $dataHpp[$key]['total_harga'],
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

    public function destroyInput($id): RedirectResponse
    {
        try {
            // Temukan record berdasarkan ID
            $GradingKasarHasil = GradingKasarHasil::findOrFail($id);

            // Hapus semua item terkait
            $GradingKasarHasil->GradingKasarStock()->delete();

            // Hapus record utama
            $GradingKasarHasil->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('grading_kasar_hasil.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('grading_kasar_hasil.index')->with('error', 'Gagal menghapus data');
        }
    }
}
