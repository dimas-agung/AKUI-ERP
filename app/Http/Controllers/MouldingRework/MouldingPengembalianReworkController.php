<?php

namespace App\Http\Controllers\MouldingRework;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MouldingPengembalianRework;
use App\Models\MouldingPersiapanReworkStock;

class MouldingPengembalianReworkController extends Controller
{
    //index
    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingPengembalianRework::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingPengembalianRework::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $MouldingPengembalianRework = $query->get();
        } else {
            $MouldingPengembalianRework = MouldingPengembalianRework::limit(1000)
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
        $MouldingStockRework = MouldingPersiapanReworkStock::where('status', 1)->get();
        return response()->view('MouldingRework.MouldingPengembalianRework.create', [
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
}
