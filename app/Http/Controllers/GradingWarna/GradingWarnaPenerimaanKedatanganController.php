<?php

namespace App\Http\Controllers\GradingWarna;

use Illuminate\Http\Request;
use App\Models\TransitKedatangan;
use App\Http\Controllers\Controller;
use App\Models\GradingWarnaPenerimaanKedatangan;
use App\Services\GradingWarnaPenerimaanKedatanganService;
use Illuminate\Support\Facades\Auth;

class GradingWarnaPenerimaanKedatanganController extends Controller
{
    protected $GradingWarnaPenerimaanKedatanganService;

    public function __construct(GradingWarnaPenerimaanKedatanganService $GradingWarnaPenerimaanKedatanganService)
    {
        $this->GradingWarnaPenerimaanKedatanganService = $GradingWarnaPenerimaanKedatanganService;
    }
    // index
    public function index(Request $request)
    {
        // $user = auth()->user()->plant;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingWarnaPenerimaanKedatangan::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingWarnaPenerimaanKedatangan::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $GradingWarnaPenerimaanKedatangan = $query->with('GradingWarnaPenerimaanStock')->latest()->get();
        } else {
            $GradingWarnaPenerimaanKedatangan = GradingWarnaPenerimaanKedatangan::limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('GradingWarna.GradingWarnaPenerimaanKedatangan.index', [
            'grading_warna_penerimaan_kedatangan' => $GradingWarnaPenerimaanKedatangan,
        ]);
    }
    // create
    public function create()
    {
        $TransitKedatangan = TransitKedatangan::where('status', TransitKedatangan::STATUS_AKTIF)->where('tujuan_kirim','UMD_'.Auth::user()->plant)
            ->distinct('nomor_bstb')
            ->pluck('nomor_bstb');
        // return $TransitKedatangan;
        return response()->view('GradingWarna.GradingWarnaPenerimaanKedatangan.create', [
            'transit_kedatangan' => $TransitKedatangan,
        ]);
    }
    // setNomorBSTB
    public function setBSTB(Request $request)
    {
        $nomor_bstb = $request->get('nomor_bstb');
        $data = TransitKedatangan::where('nomor_bstb', $nomor_bstb)
            ->where('status', TransitKedatangan::STATUS_AKTIF)
            ->get();

        return response()->json($data);
    }
    // store
    public function store(Request $request)
    {
        return $this->GradingWarnaPenerimaanKedatanganService->store($request);
    }

    // destroy
    public function destroy($nomor_job)
    {
        return $this->GradingWarnaPenerimaanKedatanganService->destroy($nomor_job);
    }
}
