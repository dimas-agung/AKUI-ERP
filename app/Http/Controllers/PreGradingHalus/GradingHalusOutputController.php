<?php

namespace App\Http\Controllers\PreGradingHalus;


use App\Models\GradingHalusOutput;
use App\Models\GradingHalusStock;
use App\Models\MasterTujuanKirimGradingHalus;
use App\Services\GradingHalusOutputService;
use App\Services\HppService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class GradingHalusOutputController extends Controller
{
    public function index(){
        $i =1;
        $PreGHI = GradingHalusOutput::with('GradingHalusStock')->get();
        $TransitPre = GradingHalusStock::with('GradingHalusOutput')->get();
        // return $TransitPre;

        return response()->view('PreGradingHalus.GradingHalusOutput.index', [
            'PreGHI' => $PreGHI,
            'TransitPre' => $TransitPre,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $PreGHI = GradingHalusOutput::with('GradingHalusStock')->get();
        $TransitPre = GradingHalusStock::with('GradingHalusOutput')->get();
        $TujuanKirimGHI = MasterTujuanKirimGradingHalus::with('GradingHalusOutput')->get();
        // return $TujuanKirimGHI;
        return view('PreGradingHalus.GradingHalusOutput.create', compact('PreGHI', 'TransitPre', 'TujuanKirimGHI'));
    }

    public function set(Request $request)
    {
        $id_box_grading_halus = $request->id_box_grading_halus;
        $data = GradingHalusStock::where('id_box_grading_halus',$id_box_grading_halus)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setUnit(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim; // Perbaikan disini
        $data = MasterTujuanKirimGradingHalus::where('tujuan_kirim', $tujuan_kirim)->first();

        return response()->json($data);
    }

    protected $GradingHalusOutputService;

    public function __construct(GradingHalusOutputService $GradingHalusOutputService, HppService $HppService)
    {
        $this->GradingHalusOutputService = $GradingHalusOutputService;
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
