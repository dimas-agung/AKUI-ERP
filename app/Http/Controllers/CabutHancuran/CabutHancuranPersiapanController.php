<?php

namespace App\Http\Controllers\CabutHancuran;

use App\Http\Controllers\Controller;
use App\Models\CabutHancuranPersiapan;
use App\Models\RambangBasahStock;
use App\Services\CabutHancuranPersiapanService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CabutHancuranPersiapanController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = CabutHancuranPersiapan::get();


        return response()->view('CabutHancuran.CabutHancuranPersiapan.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create()
    {
        $CBPenerimaan = CabutHancuranPersiapan::with('RambangBasahStock')->get();
        $stockTGK = RambangBasahStock::with('CabutHancuranPersiapan')->get();
        // $stockTGK->filter(function ($item) {
        //     return Str::endsWith($item->id_box_hcr_kotor, Auth::user()->unit->perusahaan->plant) == true;
        // })->values();
        // $stockTGK->each(function ($item, int $key) {
        //     if (Str::endsWith($item->id_box_hcr_kotor, Auth::user()->unit->perusahaan->plant) == false) {
        //         return false;
        //     }
        // });
        // return $stockTGK;
        return view('CabutHancuran.CabutHancuranPersiapan.create', compact('stockTGK', 'CBPenerimaan'));
    }

    public function set(Request $request)
    {
        $id_box_hcr_kotor = $request->id_box_hcr_kotor;
        $data = RambangBasahStock::where('id_box_hcr_kotor',$id_box_hcr_kotor)->first();
        $data = RambangBasahStock::where('id_box_hcr_kotor',$id_box_hcr_kotor)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function sendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = RambangBasahStock::whereIn('id_box_hcr_kotor', $idBoxes)->pluck('id_box_hcr_kotor')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $CabutHancuranPersiapanService;

    public function __construct(CabutHancuranPersiapanService $CabutHancuranPersiapanService)
    {
        $this->CabutHancuranPersiapanService = $CabutHancuranPersiapanService;
    }

    public function store(Request $request)
    {
        return $this->CabutHancuranPersiapanService->store($request);
    }

    public function destroy($id_stock_hcr_kotor): RedirectResponse
    {
        return $this->CabutHancuranPersiapanService->destroy($id_stock_hcr_kotor);
    }
}
