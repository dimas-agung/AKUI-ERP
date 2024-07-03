<?php

namespace App\Http\Controllers\PreGradingHalus;


use App\Models\GradingHalusOutput;
use App\Models\GradingHalusStock;
use App\Models\MasterTujuanKirimGradingHalus;
use App\Models\MasterJenisGradingHalus;
use App\Services\GradingHalusOutputService;
use App\Services\HppService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class GradingHalusOutputController extends Controller
{
    protected $GradingHalusOutputService;

    public function __construct(GradingHalusOutputService $GradingHalusOutputService, HppService $HppService)
    {
        $this->GradingHalusOutputService = $GradingHalusOutputService;
    }
    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingHalusOutput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingHalusOutput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->get();
        }else{
            $PreGHI = GradingHalusOutput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('PreGradingHalus.GradingHalusOutput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $TransitPre = GradingHalusStock::where('sisa_berat', '>', 0)->get();
        $TujuanKirimGHI = MasterTujuanKirimGradingHalus::where('status', '>', 0)->get();
        // return $TujuanKirimGHI;
        return view('PreGradingHalus.GradingHalusOutput.create', compact('TransitPre', 'TujuanKirimGHI'));
    }

    public function set(Request $request)
    {
        $id_box_grading_halus = $request->id_box_grading_halus;
        $data = GradingHalusStock::where('id_box_grading_halus',$id_box_grading_halus)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimGradingHalus::where('tujuan_kirim',$tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setUnit(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim; // Perbaikan disini
        $data = MasterTujuanKirimGradingHalus::where('tujuan_kirim', $tujuan_kirim)->first();

        return response()->json($data);
    }

    public function setUpah(Request $request)
    {
        $jenis = $request->jenis; // Perbaikan disini
        $data = MasterJenisGradingHalus::where('jenis', $jenis)->first();

        return response()->json($data);
    }

    public function sendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = GradingHalusStock::whereIn('id_box_grading_halus', $idBoxes)->pluck('id_box_grading_halus')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }


    public function store(Request $request)
    {
        return $this->GradingHalusOutputService->store($request);
    }


    public function destroy($nomor_grading): RedirectResponse
    {
        return $this->GradingHalusOutputService->destroy($nomor_grading);
    }
}
