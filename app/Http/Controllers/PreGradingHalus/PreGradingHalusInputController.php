<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Models\PreCleaningOutput;
use App\Models\PreGradingHalusInput;
use App\Http\Controllers\Controller;
use App\Models\PreGradingHalusStock;
use App\Models\TransitPreCleaningStock;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\PreGradingHalusInputService;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PreGradingHalusInputController extends Controller
{
    //
    public function index(Request $request){
        $i =1;
        $PreGHI = PreGradingHalusInput::with('TransitPreCleaningStock')->get();
        // $TransitPre = PreGradingHalusStock::with('PreGradingHalusInput')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = PreGradingHalusInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(PreGradingHalusInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->with('TransitPreCleaningStock')->get();
        }else{
            $PreGHI = PreGradingHalusInput::with('TransitPreCleaningStock')
            // ->where('created_at','>=', Carbon::now()->subDays(2))
            ->limit(1000)
            ->latest()
            ->get();
        }
        // return $GradingKI;

        return response()->view('PreGradingHalus.PreGradingHalusInput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create(): View
    {
        // $PreGHI = PreGradingHalusInput::with('TransitPreCleaningStock')->get();
        $TransitPre = TransitPreCleaningStock::with('PreGradingHalusInput')->get();
        $Unit = Unit::with('PreGradingHalusInput')->get();
        // return $PrmRawMOIC;
        return view('PreGradingHalus.PreGradingHalusInput.create', compact('TransitPre', 'Unit'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        // $data = TransitPreCleaningStock::where('nomor_bstb',$nomor_bstb)->first();
        $data = TransitPreCleaningStock::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    public function setUnit(Request $request)
    {
        $nama = $request->nama;
        $data = Unit::where('nama',$nama)->first();
        $data = Unit::where('nama',$nama)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = TransitPreCleaningStock::whereIn('nomor_bstb', $idBoxes)->pluck('nomor_bstb')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $PreGradingHalusInputService;

    public function __construct(PreGradingHalusInputService $PreGradingHalusInputService)
    {
        $this->PreGradingHalusInputService = $PreGradingHalusInputService;
    }

    public function store(Request $request)
    {
        return $this->PreGradingHalusInputService->store($request);
    }


    public function destroy($nomor_bstb): RedirectResponse
    {
        return $this->PreGradingHalusInputService->destroy($nomor_bstb);
    }
}
