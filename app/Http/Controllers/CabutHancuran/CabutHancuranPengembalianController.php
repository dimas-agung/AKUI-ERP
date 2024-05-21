<?php

namespace App\Http\Controllers\CabutHancuran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CabutHancuranPenyebaran;
use App\Models\CabutHancuranPengembalian;
use App\Services\CabutHancuranPengembalianService;

class CabutHancuranPengembalianController extends Controller
{
    // index
    public function index()
    {
        $CabutHancuranPengembalian = CabutHancuranPengembalian::all();

        return response()->view('CabutHancuran.CabutHancuranPengembalian.index', [
            'cabut_hancuran_pengembalian' => $CabutHancuranPengembalian,
        ]);
    }

    // create
    public function create()
    {
        $CabutHancuranPengembalian = CabutHancuranPengembalian::all();
        $CabutHancuranPenyebaran = CabutHancuranPenyebaran::all();
        $getUnusedNomorJob = CabutHancuranPenyebaran::withCount('CabutHancuranPengembalian')->get();
        // return $getUnusedNomorJob;
        return view('CabutHancuran.CabutHancuranPengembalian.create', [
            'cabut_hancuran_pengembalian' => $CabutHancuranPengembalian,
            'cabut_hancuran_penyeabaran' => $CabutHancuranPenyebaran,
            'get_unused_nomor_job' => $getUnusedNomorJob,
        ]);
    }

    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = CabutHancuranPenyebaran::where('nomor_job', $nomor_job)
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
        $unavailableBoxes = CabutHancuranPenyebaran::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $CabutHancuranPengembalianService;

    public function __construct(CabutHancuranPengembalianService $CabutHancuranPengembalianService)
    {
        $this->CabutHancuranPengembalianService = $CabutHancuranPengembalianService;
    }

    public function store(Request $request)
    {
        return $this->CabutHancuranPengembalianService->store($request);
    }

    public function destroy($nomor_job)
    {
        return $this->CabutHancuranPengembalianService->destroy($nomor_job);
    }
}
