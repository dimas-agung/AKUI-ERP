<?php

namespace App\Http\Controllers\DryAWaste;

use App\Http\Controllers\Controller;
use App\Models\DryAWasteOutput;
use App\Models\DryAWasteStock;
use App\Models\MasterTujuanKirimWaste;
use App\Services\DryAWasteOutputService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DryAWasteOutputController extends Controller
{
    protected $DryAWasteOutputService;

    public function __construct(DryAWasteOutputService $DryAWasteOutputService)
    {
        $this->DryAWasteOutputService = $DryAWasteOutputService;
    }
    public function index(){
        $i =1;
        $PreGHI = DryAWasteOutput::with('DryAWasteStock')->get();
        // return $TransitPre;

        return response()->view('DryAWaste.DryAWasteOutput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $TransitPre = DryAWasteStock::with('DryAWasteOutput')->get();
        $TujuanKirimGHI = MasterTujuanKirimWaste::with('DryAWasteOutput')->get();
        // return $TujuanKirimGHI;
        return view('DryAWaste.DryAWasteOutput.create', compact('TransitPre', 'TujuanKirimGHI'));
    }

    public function set(Request $request)
    {
        $jenis_waste = $request->jenis_waste;
        $data = DryAWasteStock::where('jenis_waste',$jenis_waste)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimWaste::where('tujuan_kirim',$tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function sendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = DryAWasteStock::whereIn('jenis_waste', $idBoxes)->pluck('jenis_waste')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }


    public function store(Request $request)
    {
        return $this->DryAWasteOutputService->store($request);
    }


    public function destroy($jenis_waste): RedirectResponse
    {
        return $this->DryAWasteOutputService->destroy($jenis_waste);
    }
}
