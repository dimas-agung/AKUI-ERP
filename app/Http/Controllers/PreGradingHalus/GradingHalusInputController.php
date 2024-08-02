<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Models\GradingHalusInput;
use App\Models\PreGradingHalusAddingStock;
use App\Models\TransitPreCleaningStock;
use App\Models\MasterJenisGradingHalus;
use App\Services\GradingHalusInputService;
use App\Services\HppService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class GradingHalusInputController extends Controller
{
    public function index(Request $request){
        $i =1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingHalusInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingHalusInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->with('PreGradingHalusAddingStock')->get();
        }else{
            $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')
            // ->where('created_at','>=', Carbon::now()->subDays(2))
            ->limit(1000)
            ->latest()
            ->get();
        }

        // $TransitPre = PreGradingHalusAddingStock::with('GradingHalusInput')->get();
        // return $GradingKI;

        $query = GradingHalusInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingHalusInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->get();
        }else{
            $PreGHI = GradingHalusInput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('PreGradingHalus.GradingHalusInput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $TransitPre = PreGradingHalusAddingStock::get();
        $Unit = MasterJenisGradingHalus::where('status',1)->get();
        // return $TransitPre;
        return view('PreGradingHalus.GradingHalusInput.create', compact('TransitPre', 'Unit'));
    }

    public function set(Request $request)
    {
        $nomor_grading = $request->nomor_grading;
        $data = PreGradingHalusAddingStock::where('status_stock', '>', 0)->where('nomor_grading',$nomor_grading)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setUnit(Request $request)
    {
        $jenis = $request->jenis; // Perbaikan disini
        $data = MasterJenisGradingHalus::where('jenis', $jenis)->first();

        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = PreGradingHalusAddingStock::whereIn('nomor_grading', $idBoxes)->pluck('nomor_grading')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $GradingHalusInputService;

    public function __construct(GradingHalusInputService $GradingHalusInputService, HppService $HppService)
    {
        $this->GradingHalusInputService = $GradingHalusInputService;
    }

    public function store(Request $request)
    {
        return $this->GradingHalusInputService->store($request);
    }


    public function destroy($nomor_grading): RedirectResponse
    {
        return $this->GradingHalusInputService->destroy($nomor_grading);
    }
}
