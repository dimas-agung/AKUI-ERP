<?php

namespace App\Http\Controllers\GradingWarna;

use App\Models\GradingWarna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GradingWarnaService;
use App\Models\GradingWarnaAddingStock;
use App\Models\MasterJenisGradingWarna;

class GradingWarnaController extends Controller
{
    protected $GradingWarnaService;

    public function __construct(GradingWarnaService $GradingWarnaService)
    {
        $this->GradingWarnaService = $GradingWarnaService;
    }
    //index
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingWarna::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingWarna::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $GradingWarna = $query->with('GradingWarnaAddingStock')->get();
        } else {
            $GradingWarna = GradingWarna::with('GradingWarnaAddingStock')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('GradingWarna.GradingWarna.index', [
            'grading_warna' => $GradingWarna,
        ]);
    }

    // create
    public function create()
    {
        $GradingWarnaAddingStock = GradingWarnaAddingStock::where('sisa_berat', '!=', 0)->get();
        $MasterJenisGradingWarna = MasterJenisGradingWarna::where('status', 1)->get();
        // return $GradingWarnaAddingStock;
        return view('GradingWarna.GradingWarna.create', [
            'grading_warna_adding_stock' => $GradingWarnaAddingStock,
            'master_jenis_grading_warna' => $MasterJenisGradingWarna,
        ]);
    }
    // set nomor lot
    public function setLot(Request $request)
    {
        $nomor_lot = $request->nomor_lot;
        $data = GradingWarnaAddingStock::where('nomor_lot', $nomor_lot)
            ->first();
        // return $data;
        return response()->json($data);
    }
    // set jenis
    public function setJenis(Request $request)
    {
        $jenis_grading = $request->jenis_grading;
        $data = MasterJenisGradingWarna::where('jenis', $jenis_grading)
            ->first();
        // return $data;
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idNomorLot = json_decode($request->idNomorLot);

        // Cek ketersediaan id box dalam database
        $unavailableNomorLot = GradingWarnaAddingStock::whereIn('nomor_lot', $idNomorLot)->pluck('nomor_lot')->toArray();
        // return $unavailableNomorLot;
        // Filter id box yang tidak tersedia
        $availableNomorLot = array_diff($idNomorLot, $unavailableNomorLot);
        // return $availableNomorLot;
        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableNomorLot' => $availableNomorLot]);
    }

    public function store(Request $request)
    {
        return $this->GradingWarnaService->store($request);
    }

    public function destroy($nomor_lot)
    {
        return $this->GradingWarnaService->destroy($nomor_lot);
    }
}
