<?php

namespace App\Http\Controllers\MouldingRework;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\MouldingPenyebaranRework;
use App\Models\MouldingPengembalianRework;
use App\Services\MouldingPengembalianReworkService;

class MouldingPengembalianReworkController extends Controller
{
    protected $MouldingPengembalianReworkService;

    public function __construct(MouldingPengembalianReworkService $MouldingPengembalianReworkService)
    {
        $this->MouldingPengembalianReworkService = $MouldingPengembalianReworkService;
    }
    //index
    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $plant = auth()->user()->plant;

        $query = MouldingPengembalianRework::query();

        if ($startDate && $endDate) {
            $query->whereBetween(MouldingPengembalianRework::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $MouldingPengembalianRework = $query->where('tujuan_kirim',  $plant)
                ->get();
        } else {
            $MouldingPengembalianRework = MouldingPengembalianRework::limit(1000)
                ->where('tujuan_kirim',  $plant)
                ->latest()
                ->get();
        }

        return response()->view('MouldingRework.MouldingPengembalianRework.index', [
            'moulding_pengembalian_rework' => $MouldingPengembalianRework,
            // 'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $MouldingStockRework = MouldingPenyebaranRework::where('status', 1)->get();
        return response()->view('MouldingRework.MouldingPengembalianRework.create', [
            'moulding_stock_rework' => $MouldingStockRework,
        ]);
    }
    public function setJob(Request $request)
    {
        $nomor_job_rework = $request->nomor_job_rework;
        $data = MouldingPenyebaranRework::where('nomor_job_rework', $nomor_job_rework)
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = MouldingPenyebaranRework::whereIn('nomor_job_rework', $idBoxes)->pluck('nomor_job_rework')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        // return $request;
        return $this->MouldingPengembalianReworkService->store($request);
    }

    public function destroy($nomor_job_rework): RedirectResponse
    {
        return $this->MouldingPengembalianReworkService->destroy($nomor_job_rework);
    }
}
