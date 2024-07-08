<?php

namespace App\Http\Controllers\DryAHancuran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\DryAPenerimaanHancuran;
use App\Models\TransitCabutBuluHancuran;
use App\Services\DryAPenerimaanHancuranService;

class DryAPenerimaanHancuranController extends Controller
{
    // Index
    // public function index(){
    //     $i =1;
    //     $PreGHI = DryAPenerimaanHancuran::get();
    //     // return $GradingKI;

    //     return response()->view('DryAHancuran.DryAPenerimaan.index', [
    //         'PreGHI' => $PreGHI,
    //         'i' => $i,
    //     ]);
    // }
    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DryAPenerimaanHancuran::query();


        if ($startDate && $endDate) {
            $query->whereBetween(DryAPenerimaanHancuran::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->get();
        }else{
            $PreGHI = DryAPenerimaanHancuran::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('DryAHancuran.DryAPenerimaan.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $PreGHI = DryAPenerimaanHancuran::with('TransitCabutBuluHancuran')->get();
        $TransitPre = TransitCabutBuluHancuran::with('DryAPenerimaanHancuran')->get();
        // return $TransitPre;
        return view('DryAHancuran.DryAPenerimaan.create', compact('PreGHI', 'TransitPre'));
    }

    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = TransitCabutBuluHancuran::where('nomor_job',$nomor_job)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = TransitCabutBuluHancuran::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $DryAPenerimaanHancuranService;

    public function __construct(DryAPenerimaanHancuranService $DryAPenerimaanHancuranService)
    {
        $this->DryAPenerimaanHancuranService = $DryAPenerimaanHancuranService;
    }

    public function store(Request $request)
    {
        return $this->DryAPenerimaanHancuranService->store($request);
    }
    public function destroy($nomor_job): RedirectResponse
    {
        return $this->DryAPenerimaanHancuranService->destroy($nomor_job);
    }
}
