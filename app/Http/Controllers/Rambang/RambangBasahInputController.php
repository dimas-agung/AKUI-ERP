<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\RambangBasahInput;
use App\Models\MasterJenisRambang;
use App\Models\HcrKotorStock;
use App\Services\InputRambangBasahService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RambangBasahInputController extends Controller
{

    protected $InputRambangBasahService;

    public function __construct(InputRambangBasahService $InputRambangBasahService)
    {
        $this->InputRambangBasahService = $InputRambangBasahService;
    }

    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = RambangBasahInput::all();
        // return($jenis);

        return response()->view('Rambang.RambangBasahInput.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $PreGHI = RambangBasahInput::with('HcrKotorStock')->get();
        $TransitPre = HcrKotorStock::with('RambangBasahInput')->get();
        $Unit = MasterJenisRambang::with('RambangBasahInput')->get();
        // return $TransitPre;
        return view('Rambang.RambangBasahInput.create', compact('PreGHI', 'TransitPre', 'Unit'));
    }

    public function set(Request $request)
    {
        $id_box_hcr_kotor = $request->id_box_hcr_kotor;
        $data = HcrKotorStock::where('id_box_hcr_kotor',$id_box_hcr_kotor)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
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
