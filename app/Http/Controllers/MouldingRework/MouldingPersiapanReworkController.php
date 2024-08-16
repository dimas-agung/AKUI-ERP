<?php

namespace App\Http\Controllers\MouldingRework;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MouldingPersiapanRework;
use App\Models\TransitFinalGradingRework;
use App\Services\MouldingPersiapanReworkService;
use Illuminate\Http\RedirectResponse;

class MouldingPersiapanReworkController extends Controller
{
    protected $MouldingPersiapanReworkService;

    public function __construct(MouldingPersiapanReworkService $MouldingPersiapanReworkService)
    {
        $this->MouldingPersiapanReworkService = $MouldingPersiapanReworkService;
    }

    // public function index(Request $request){
    //     $i = 1;
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     $query = MouldingPersiapanRework::query();


    //     if ($startDate && $endDate) {
    //         $query->whereBetween(MouldingPersiapanRework::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
    //         $MouldingPR = $query->get();
    //     }else{
    //         $MouldingPR = MouldingPersiapanRework::limit(1000)
    //         ->latest()
    //         ->get();
    //     }
    //     return response()->view('MouldingRework.MouldingPersiapanRework.index', [
    //         'MouldingPR' => $MouldingPR,
    //         'i' => $i,
    //     ]);
    // }

    public function index(Request $request) {
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $plant = auth()->user()->plant; // Ambil input plant dari user

        $query = MouldingPersiapanRework::query();

        if ($startDate && $endDate) {
            $query->whereBetween(MouldingPersiapanRework::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $MouldingPR = $query->where('tujuan_kirim',  $plant)
            ->get();
        } else {
            $MouldingPR = MouldingPersiapanRework::limit(1000)
            ->where('tujuan_kirim',  $plant)
            ->latest()
            ->get();
        }

        $MouldingPR = $query->latest()->limit(1000)->get();

        return response()->view('MouldingRework.MouldingPersiapanRework.index', [
            'MouldingPR' => $MouldingPR,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create(): View
    {
        $MouldingPR = MouldingPersiapanRework::get();
        $TransitFGR = TransitFinalGradingRework::get();
        // return $TransitFGR;
        return view('MouldingRework.MouldingPersiapanRework.create', compact('TransitFGR', 'MouldingPR'));
    }
    public function set(Request $request)
    {
        $nomor_job_rework = $request->nomor_job_rework;
        $data = TransitFinalGradingRework::where('nomor_job_rework', $nomor_job_rework)->get();

        // Kembalikan data sebagai respons JSON
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = TransitFinalGradingRework::whereIn('nomor_job_rework', $idBoxes)->pluck('nomor_job_rework')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->MouldingPersiapanReworkService->store($request);
    }

    public function destroy($nomor_job_rework): RedirectResponse
    {
        return $this->MouldingPersiapanReworkService->destroy($nomor_job_rework);
    }
}
