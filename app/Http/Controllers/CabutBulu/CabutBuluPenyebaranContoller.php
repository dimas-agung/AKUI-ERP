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
    // index
    public function index()
    {
        $i = 1;
        $CabutBuluPenyebaran = CabutBuluPenyebaran::all();
        return response()->view('CabutBulu.CabutBuluPenyebaran.index', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
            'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $MasterOperator = MasterOperator::all();
        $CabutBuluPenyebaran = CabutBuluPenyebaran::all();
        $CabutBuluStock = CabutBuluStock::all();
        // $getUnusedNomorJob = CabutBuluPenyebaran::withCount('CabutBuluStock')->get();
        $getUnusedNomorJob = CabutBuluStock::withCount('CabutBuluPenyebaran')->get();
        // return $getUnusedNomorJob;
        return view('CabutBulu.CabutBuluPenyebaran.create', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
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
        // $unavailableBoxes = TransitPreWash::whereIn('nomor_bstb', $idBoxes)->pluck('nomor_bstb')->toArray();
        $unavailableBoxes = CabutBuluStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $CabutBuluPenyebaranService;

    public function __construct(CabutBuluPenyebaranService $CabutBuluPenyebaranService)
    {
        $this->CabutBuluPenyebaranService = $CabutBuluPenyebaranService;
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
