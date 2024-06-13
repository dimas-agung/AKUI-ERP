<?php

namespace App\Http\Controllers\DryAHancuran;

use Illuminate\Http\Request;
use App\Models\MasterJenisDryA;
use Illuminate\Support\Facades\DB;
use App\Models\DryAGradingHancuran;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\DryAPenerimaanHancuran;
use App\Models\DryAGradingHancuranStock;
use App\Services\DryAGradingCabutService;
use App\Models\DryAPenerimaanHancuranStock;
use App\Services\DryAGradingHancuranService;

class DryAGradingHancuranController extends Controller
{
    //index
    public function index()
    {
        $DryAGradingHancuran = DryAGradingHancuran::all();
        return response()->view('DryAHancuran.DryAGradingHancuran.index', [
            'dry_a_grading_hancuran' => $DryAGradingHancuran,
        ]);
    }

    // create
    public function create()
    {
        $DryAPenerimaanHancuranStock = DryAPenerimaanHancuranStock::withCount('DryAGradingHancuran')->get();
        $MasterJenisDryA = MasterJenisDryA::all();
        // return $DryAPenerimaanHancuranStock;
        return response()->view('DryAHancuran.DryAGradingHancuran.create', [
            'dry_a_penerimaan_hancuran_stock' => $DryAPenerimaanHancuranStock,
            'master_jenis_dry_a' => $MasterJenisDryA,
        ]);
    }

    // set Nomor Job
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = DryAPenerimaanHancuranStock::where('nomor_job', $nomor_job)->first();
        return response()->json($data);
    }

    // set Master Jenis
    public function setJenis(Request $request)
    {
        $jenis_grading = $request->jenis_grading;
        $data = MasterJenisDryA::where('jenis', $jenis_grading)->first();
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = DryAPenerimaanHancuranStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $DryAGradingHancuranService;

    public function __construct(DryAGradingHancuranService $DryAGradingHancuranService)
    {
        $this->DryAGradingHancuranService = $DryAGradingHancuranService;
    }

    public function store(Request $request)
    {
        return $this->DryAGradingHancuranService->store($request);
    }

    public function destroy($nomor_job)
    {
        return $this->DryAGradingHancuranService->destroy($nomor_job);
    }
}
