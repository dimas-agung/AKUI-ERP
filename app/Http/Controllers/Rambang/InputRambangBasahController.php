<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\RambangBasahInput;
use App\Models\MasterJenisRambang;
use App\Models\HcrKotorStock;
use App\Services\InputRambangBasahService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InputRambangBasahController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = RambangBasahInput::all();
        // return($jenis);

        return response()->view('Rambang.InputRambangBasah.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $PreGHI = RambangBasahInput::with('StockHcrKotor')->get();
        $TransitPre = HcrKotorStock::with('InputRambangBasah')->get();
        $Unit = MasterJenisRambang::with('InputRambangBasah')->get();
        // return $TransitPre;
        return view('Rambang.InputRambangBasah.create', compact('PreGHI', 'TransitPre', 'Unit'));
    }

    public function set(Request $request)
    {
        $id_box_hcr_kotor = $request->id_box_hcr_kotor;
        $data = HcrKotorStock::where('id_box_hcr_kotor',$id_box_hcr_kotor)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    protected $InputRambangBasahService;

    public function __construct(InputRambangBasahService $InputRambangBasahService)
    {
        $this->InputRambangBasahService = $InputRambangBasahService;
    }

    public function store(Request $request)
    {
        return $this->InputRambangBasahService->store($request);
    }


    public function destroy($id): RedirectResponse
    {
        return $this->InputRambangBasahService->destroy($id);
    }
}
