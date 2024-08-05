<?php

namespace App\Http\Controllers\MouldingRework;

use App\Http\Controllers\Controller;
use App\Models\MouldingPenyebaranRework;
use App\Models\MouldingPersiapanReworkStock;
use App\Services\MouldingPenyebaranReworkService;
use Illuminate\Http\Request;

class MouldingPenyebaranReworkController extends Controller
{
    protected $MouldingPenyebaranReworkService;

    public function __construct(MouldingPenyebaranReworkService $MouldingPenyebaranReworkService)
    {
        $this->MouldingPenyebaranReworkService = $MouldingPenyebaranReworkService;
    }
    //index
    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingPenyebaranRework::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingPenyebaranRework::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $MouldingPenyebaranRework = $query->get();
        } else {
            $MouldingPenyebaranRework = MouldingPenyebaranRework::limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('MouldingRework.MouldingPenyebaranRework.index', [
            'moulding_penyebaran_rework' => $MouldingPenyebaranRework,
            // 'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $MouldingStockRework = MouldingPersiapanReworkStock::where('status', 1)->get();
        return response()->view('MouldingRework.MouldingPenyebaranRework.create', [
            'moulding_stock_rework' => $MouldingStockRework,
        ]);
    }
    public function setJob(Request $request)
    {
        $nomor_job_rework = $request->nomor_job_rework;
        $data = MouldingPersiapanReworkStock::where('nomor_job_rework', $nomor_job_rework)
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
        $unavailableBoxes = MouldingPersiapanReworkStock::whereIn('nomor_job_rework', $idBoxes)->pluck('nomor_job_rework')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->MouldingPenyebaranReworkService->store($request);
    }
}
