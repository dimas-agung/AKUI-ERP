<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Models\GradingHalusInput;
use App\Models\PreGradingHalusAddingStock;
use App\Models\TransitPreCleaningStock;
use App\Models\MasterJenisGradingHalus;
use App\Services\GradingHalusInputService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class GradingHalusInputController extends Controller
{
    public function index(){
        $i =1;
        $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $TransitPre = PreGradingHalusAddingStock::with('GradingHalusInput')->get();
        // return $GradingKI;

        return response()->view('PreGradingHalus.GradingHalusInput.index', [
            'PreGHI' => $PreGHI,
            'TransitPre' => $TransitPre,
            'i' => $i,
        ]);
    }

    public function create(): View
    {
        $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $TransitPre = PreGradingHalusAddingStock::with('GradingHalusInput')->get();
        $Unit = MasterJenisGradingHalus::with('GradingHalusInput')->get();
        // return $PrmRawMOIC;
        return view('PreGradingHalus.GradingHalusInput.create', compact('PreGHI', 'TransitPre', 'Unit'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = PreGradingHalusAddingStock::where('nomor_bstb',$nomor_bstb)->first();
        $data = PreGradingHalusAddingStock::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    public function setUnit(Request $request)
    {
        $nama = $request->nama;
        $data = MasterJenisGradingHalus::where('nama',$nama)->first();
        $data = MasterJenisGradingHalus::where('nama',$nama)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    protected $GradingHalusInputService;

    public function __construct(GradingHalusInputService $GradingHalusInputService)
    {
        $this->GradingHalusInputService = $GradingHalusInputService;
    }

    public function store(Request $request)
    {
        return $this->GradingHalusInputService->store($request);
    }


    public function destroy($nomor_bstb): RedirectResponse
    {
        return $this->GradingHalusInputService->destroy($nomor_bstb);
    }
}
