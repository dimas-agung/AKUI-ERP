<?php

namespace App\Http\Controllers\CabutBulu;

use Illuminate\Http\Request;
use App\Models\CabutBuluStock;
use App\Models\MasterOperator;
use App\Models\CabutBuluPenyebaran;
use App\Http\Controllers\Controller;
use App\Services\CabutBuluPenyebaranService;

class CabutBuluPenyebaranContoller extends Controller
{
    protected $CabutBuluPenyebaranService;

    public function __construct(CabutBuluPenyebaranService $CabutBuluPenyebaranService)
    {
        $this->CabutBuluPenyebaranService = $CabutBuluPenyebaranService;
    }

    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = CabutBuluPenyebaran::query();


        if ($startDate && $endDate) {
            $query->whereBetween(CabutBuluPenyebaran::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $CabutBuluPenyebaran = $query->with('CabutBuluStock')->get();
        } else {
            $CabutBuluPenyebaran = CabutBuluPenyebaran::with('CabutBuluStock')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('CabutBulu.CabutBuluPenyebaran.index', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
            // 'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $MasterOperator = MasterOperator::where('status', 1)->get();
        $CabutBuluStock = CabutBuluStock::where('status', 1)->get();
        $getUnusedNomorJob = CabutBuluStock::withCount('CabutBuluPenyebaran')->get();
        // return $getUnusedNomorJob;
        return view('CabutBulu.CabutBuluPenyebaran.create', [
            'master_operators' => $MasterOperator,
            'cabut_bulu_stocks' => $CabutBuluStock,
            'get_unused_nomor_job' => $getUnusedNomorJob,
        ]);
    }

    //set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = CabutBuluStock::where('nomor_job', $nomor_job)
            ->first();
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }
    public function setNip(Request $request)
    {
        $nip = $request->nip;
        $data = MasterOperator::where('nip', $nip)
            ->first();
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = CabutBuluStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->CabutBuluPenyebaranService->store($request);
    }

    public function destroy($nomor_job)
    {
        return $this->CabutBuluPenyebaranService->destroy($nomor_job);
    }
}
