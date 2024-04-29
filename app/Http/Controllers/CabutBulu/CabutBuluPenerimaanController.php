<?php

namespace App\Http\Controllers\CabutBulu;

use App\Models\CabutBuluPenerimaan;
use App\Services\CabutBuluPenerimaanService;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\TransitPreWash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CabutBuluPenerimaanController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = CabutBuluPenerimaan::get();


        return response()->view('CabutBulu.CabutBuluPenerimaan.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create(): View
    {
        $CBPenerimaan = CabutBuluPenerimaan::with('TransitPreWash')->get();
        $stockTGK = TransitPreWash::with('CabutBuluPenerimaan')->get();
        // return $stockTGK;
        return view('CabutBulu.CabutBuluPenerimaan.create', compact('stockTGK', 'CBPenerimaan'));
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

    protected $CabutBuluPenerimaanService;

    public function __construct(CabutBuluPenerimaanService $CabutBuluPenerimaanService)
    {
        $this->CabutBuluPenerimaanService = $CabutBuluPenerimaanService;
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
