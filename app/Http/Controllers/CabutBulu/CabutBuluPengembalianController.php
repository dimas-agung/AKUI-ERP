<?php

namespace App\Http\Controllers\CabutBulu;

use App\Http\Controllers\Controller;
use App\Models\CabutBuluPengembalian;
use App\Models\CabutBuluPenyebaran;
use App\Models\CabutBuluStock;
use App\Services\CabutBuluPengembalianService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabutBuluPengembalianController extends Controller
{
    protected $CabutBuluPengembalianService;

    public function __construct(CabutBuluPengembalianService $CabutBuluPengembalianService)
    {
        $this->CabutBuluPengembalianService = $CabutBuluPengembalianService;

    }
    // index
    public function index(Request $request)
    {
        $i = 1;
        $CabutBuluPengembalian = CabutBuluPengembalian::with('TransitCabutBulu');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $CabutBuluPengembalian->whereBetween(CabutBuluPengembalian::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            if(Auth::user()->plant){
                $CabutBuluPengembalian->where('tujuan_kirim',Auth::user()->plant);
            }
            $CabutBuluPengembalian = $CabutBuluPengembalian->latest()->get();
        }else{
            if(Auth::user()->plant){
                $CabutBuluPengembalian->where('tujuan_kirim',Auth::user()->plant);
            }
            $CabutBuluPengembalian = $CabutBuluPengembalian->limit(1000)->latest()->get();
        }
        // return $CabutBuluPengembalian;
        return response()->view('CabutBulu.CabutBuluPengembalian.index', [
            'cabut_bulu_penyebarans' => $CabutBuluPengembalian,
            'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $CabutBuluPenyebaran = CabutBuluPengembalian::all();
        $CabutBuluStock = CabutBuluPenyebaran::all();
        // $getUnusedNomorJob = CabutBuluPenyebaran::withCount('CabutBuluPenyebaran')->get();
        $getUnusedNomorJob = CabutBuluPenyebaran::withCount('CabutBuluPengembalian')->get();
        // return $getUnusedNomorJob;
        return view('CabutBulu.CabutBuluPengembalian.create', [
            'cabut_bulu_penyebarans' => $CabutBuluPenyebaran,
            'cabut_bulu_stocks' => $CabutBuluStock,
            'get_unused_nomor_job' => $getUnusedNomorJob,
        ]);
    }

    //set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = CabutBuluPenyebaran::where('nomor_job', $nomor_job)
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
        $unavailableBoxes = CabutBuluPenyebaran::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }


    public function store(Request $request)
    {
        return $this->CabutBuluPengembalianService->store($request);

    }


    public function destroy($nomor_job)
    {
        return $this->CabutBuluPengembalianService->destroy($nomor_job);
    }
}