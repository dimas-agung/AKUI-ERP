<?php

namespace App\Http\Controllers\DryA;

use App\Http\Controllers\Controller;
use App\Models\DryAPenerimaanCabut;
use App\Models\TransitCabutBulu;
use App\Services\DryAPenerimaanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DryAPenerimaanController extends Controller
{
    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DryAPenerimaanCabut::query();


        if ($startDate && $endDate) {
            $query->whereBetween(DryAPenerimaanCabut::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->get();
        }else{
            $PreGHI = DryAPenerimaanCabut::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('DryA.DryAPenerimaan.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create()
    {
        // $PreGHI = DryAPenerimaanCabut::with('TransitCabutBulu')->get();
        $TransitPre = TransitCabutBulu::with('DryAPenerimaanCabut')->where('status',1)->get();
        // return $TransitPre;
        return view('DryA.DryAPenerimaan.create', compact('TransitPre'));
    }

    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = TransitCabutBulu::where('nomor_job',$nomor_job)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = TransitCabutBulu::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $DryAPenerimaanService;

    public function __construct(DryAPenerimaanService $DryAPenerimaanService)
    {
        $this->DryAPenerimaanService = $DryAPenerimaanService;
    }

    public function store(Request $request)
    {
        return $this->DryAPenerimaanService->store($request);
    }
    public function destroy($nomor_job)
    {
        return $this->DryAPenerimaanService->destroy($nomor_job);
    }
}
