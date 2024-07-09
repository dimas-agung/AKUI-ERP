<?php

namespace App\Http\Controllers\GradingWarna;

use Illuminate\Http\Request;
use App\Models\GradingWarnaAdding;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\GradingWarnaPenerimaanStock;
use App\Models\MasterTujuanKirimMoulding;
use App\Models\Perusahaan;
use App\Services\GradingWarnaAddingService;

class GradingWarnaAddingController extends Controller
{
    protected $GradingWarnaAddingService;

    public function __construct(GradingWarnaAddingService $GradingWarnaAddingService)
    {
        $this->GradingWarnaAddingService = $GradingWarnaAddingService;
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingWarnaAdding::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingWarnaAdding::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $GradingWarnaAdding = $query->with('GradingWarnaPenerimaanStock')->get();
        } else {
            $GradingWarnaAdding = GradingWarnaAdding::with('GradingWarnaPenerimaanStock')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('GradingWarna.GradingWarnaAdding.index', [
            'grading_warna_adding' => $GradingWarnaAdding,
        ]);
    }
    // create
    public function create()
    {
        $GradingWarnaPenerimaanStock = GradingWarnaPenerimaanStock::select('nomor_job')->distinct()
            ->where('status', 1)->get();
        $MasterTujuanKirimMoulding = MasterTujuanKirimMoulding::where('status', 1)->get();
        // return $GradingWarnaPenerimaanStock;
        return view('GradingWarna.GradingWarnaAdding.create', [
            'grading_warna_penerimaan_stock' => $GradingWarnaPenerimaanStock,
            'master_tujuan_kirim_moulding' => $MasterTujuanKirimMoulding,
        ]);
    }
    public function getDataByNomorJob($nomor_job)
    {
        $data = GradingWarnaPenerimaanStock::where('nomor_job', $nomor_job)->get();
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idNomorJob = json_decode($request->idNomorJob);

        // Cek ketersediaan id box dalam database
        $unavailableNomorJob = GradingWarnaPenerimaanStock::whereIn('nomor_job', $idNomorJob)->pluck('nomor_job')->toArray();
        // return $unavailableNomorJob;
        // Filter id box yang tidak tersedia
        $availableNomorJob = array_diff($idNomorJob, $unavailableNomorJob);
        // return $availableNomorJob;
        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableNomorJob' => $availableNomorJob]);
    }

    public function store(Request $request)
    {
        return $this->GradingWarnaAddingService->store($request);
    }

    public function destroy($id)
    {
        return $this->GradingWarnaAddingService->destroy($id);
    }
}
