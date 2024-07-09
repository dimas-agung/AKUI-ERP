<?php

namespace App\Http\Controllers\Rambang;

use Illuminate\Http\Request;
use App\Models\RambangBasahStock;
use App\Models\RambangKeringInput;
use App\Http\Controllers\Controller;
use App\Models\RambangKeringStock;
use App\Services\RambangKeringInputService;

class RambangKeringInputController extends Controller
{
    protected $RambangKeringInputService;
    
    public function __construct(RambangKeringInputService $RambangKeringInputService)
    {
        $this->RambangKeringInputService = $RambangKeringInputService;
    }

    // index
    public function index(Request $request){
        $i = 1;
        // $RambangKeringInput = RambangKeringInput::all();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = RambangKeringInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(RambangKeringInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $RambangKeringInput = $query->get();
        }else{
            $RambangKeringInput = RambangKeringInput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('Rambang.RambangKeringInput.index', [
            'rambang_kering_input' => $RambangKeringInput,
            // 'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $RambangBasahStock = RambangBasahStock::with('RambangKeringInput')->get();
        // return $RambangBasahStock;
        return response()->view('Rambang.RambangKeringInput.create', [
            'rambang_basah_stock' => $RambangBasahStock,
        ]);
    }

    public function set(Request $request)
    {
        $idBoxHcrKotor = $request->id_box_hcr_kotor;
        $jenisRambang = $request->jenis_rambang;

        $data = RambangBasahStock::select('sisa_berat')
            ->where('id_box_hcr_kotor', $idBoxHcrKotor)
            ->where('jenis_rambang', $jenisRambang)
            ->first();

        return response()->json(['sisa_berat' => $data ? $data->sisa_berat : 0]);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        // $unavailableBoxes = TransitPreWash::whereIn('nomor_bstb', $idBoxes)->pluck('nomor_bstb')->toArray();
        $unavailableBoxes = RambangBasahStock::whereIn('id_box_hcr_kotor', $idBoxes)->pluck('id_box_hcr_kotor')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->RambangKeringInputService->store($request);
    }

    public function destroy($id_box_hcr_kotor)
    {
        return $this->RambangKeringInputService->destroy($id_box_hcr_kotor);
    }
}
