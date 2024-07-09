<?php

namespace App\Http\Controllers\CabutBulu;

use App\Models\CabutBuluPenerimaan;
use App\Services\CabutBuluPenerimaanService;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\TransitPreWash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CabutBuluPenerimaanController extends Controller
{
    protected $CabutBuluPenerimaanService;

    public function __construct(CabutBuluPenerimaanService $CabutBuluPenerimaanService)
    {
        $this->CabutBuluPenerimaanService = $CabutBuluPenerimaanService;
    }
    //Index
    public function index(Request $request){
        $i =1;
        $CBPenerimaan = CabutBuluPenerimaan::with('TransitPreWash');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $CBPenerimaan->whereBetween(CabutBuluPenerimaan::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            if(Auth::user()->plant){
                $CBPenerimaan->where('tujuan_kirim',Auth::user()->plant);
            }
            $CabutPenerimaan = $CBPenerimaan->get();
        }else{
            if(Auth::user()->plant){
                $CBPenerimaan->where('tujuan_kirim',Auth::user()->plant);
            }
            $CabutPenerimaan = $CBPenerimaan->limit(1000)->latest()->get();
        }
        // $berat_bersih = generate_berat_bersih(299);
        // return $berat_bersih;

    //     return response()->view('CabutBulu.CabutBuluPenerimaan.index', [
    //         'CBPenerimaan' => $CBPenerimaan,
    //         'i' => $i,
    //     ]);
    // }
    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = CabutBuluPenerimaan::query();


        if ($startDate && $endDate) {
            $query->whereBetween(CabutBuluPenerimaan::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $CBPenerimaan = $query->get();
        }else{
            $CBPenerimaan = CabutBuluPenerimaan::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('CabutBulu.CabutBuluPenerimaan.index', [
            'CBPenerimaan' => $CabutPenerimaan,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create()
    {
        if(Auth::user()->plant){
            $stockTGK = TransitPreWash::where('tujuan_kirim',Auth::user()->plant)->distinct('nomor_bstb')->pluck('nomor_bstb');
        }else{
            $stockTGK = TransitPreWash::distinct('nomor_bstb')->pluck('nomor_bstb');
        }
        // return $stockTGK;
        return view('CabutBulu.CabutBuluPenerimaan.create', compact('stockTGK'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = TransitPreWash::where('nomor_bstb',$nomor_bstb)->first();
        $data = TransitPreWash::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = TransitPreWash::whereIn('nomor_bstb', $idBoxes)->pluck('nomor_bstb')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->CabutBuluPenerimaanService->store($request);
    }


    public function destroy($nomor_bstb): RedirectResponse
    {
        return $this->CabutBuluPenerimaanService->destroy($nomor_bstb);
    }
}