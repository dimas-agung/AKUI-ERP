<?php

namespace App\Http\Controllers\CabutHancuran;

use Illuminate\Http\Request;
use App\Models\MasterOperator;
use App\Http\Controllers\Controller;
use App\Models\CabutHancuranPenyebaran;
use App\Models\CabutHancuranPersiapanStock;
use App\Services\CabutHancuranPenyebaranService;

class CabutHancuranPenyebaranController extends Controller
{
    protected $CabutHancuranPenyebaranService;

    public function __construct(CabutHancuranPenyebaranService $CabutHancuranPenyebaranService)
    {
        $this->CabutHancuranPenyebaranService = $CabutHancuranPenyebaranService;
    }

    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = CabutHancuranPenyebaran::query();


        if ($startDate && $endDate) {
            $query->whereBetween(CabutHancuranPenyebaran::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $CabutHancuranPenyebaran = $query->with('CabutHancuranPersiapanStock')->get();
        } else {
            $CabutHancuranPenyebaran = CabutHancuranPenyebaran::with('CabutHancuranPersiapanStock')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('CabutHancuran.CabutHancuranPenyebaran.index', [
            'cabut_hancuran_penyebarans' => $CabutHancuranPenyebaran,
            // 'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $MasterOperator = MasterOperator::where('unit','Cabut Hancuran')->get();;
        $CabutHancuranPenyebaran = CabutHancuranPenyebaran::all();
        $CabutHancuranPersiapanStock = CabutHancuranPersiapanStock::all();
        $getUnusedNomorJob = CabutHancuranPersiapanStock::withCount('CabutHancuranPenyebaran')->get();
        // return $getUnusedNomorJob;
        return view('CabutHancuran.CabutHancuranPenyebaran.create', [
            'master_operators' => $MasterOperator,
            'get_unused_nomor_job' => $getUnusedNomorJob,
        ]);
    }

    // //set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = CabutHancuranPersiapanStock::where('nomor_job', $nomor_job)
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }
    public function setNip(Request $request)
    {
        $nip = $request->nip;
        $data = MasterOperator::where('nip', $nip)
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
        $unavailableBoxes = CabutHancuranPersiapanStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->CabutHancuranPenyebaranService->store($request);
    }


    public function destroy($nomor_job)
    {
        return $this->CabutHancuranPenyebaranService->destroy($nomor_job);
    }
}
