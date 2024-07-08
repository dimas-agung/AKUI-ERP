<?php

namespace App\Http\Controllers\DryAHancuran;

use App\Http\Controllers\Controller;
use App\Models\DryAOutputHancuran;
use App\Models\DryAGradingHancuranStock;
use App\Models\MasterTujuanKirimDryA;
use App\Services\DryAOutputHancuranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DryAOutputHancuranController extends Controller
{
    //Index
    // public function index(){
    //     $i =1;
    //     $PreCleaningI = DryAOutputHancuran::get();
    //     // return $existingItem;

    //     return response()->view('DryAHancuran.DryAOutput.index', [
    //         'PreCleaningI' => $PreCleaningI,
    //         'i' => $i,
    //     ]);
    // }
    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DryAOutputHancuran::query();


        if ($startDate && $endDate) {
            $query->whereBetween(DryAOutputHancuran::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreCleaningI = $query->get();
        }else{
            $PreCleaningI = DryAOutputHancuran::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('DryAHancuran.DryAOutput.index', [
            'PreCleaningI' => $PreCleaningI,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $PreCleaningI = DryAOutputHancuran::with('DryAGradingHancuranStock')->get();
        $MasTujKir = MasterTujuanKirimDryA::with('DryAOutputHancuran')->get();
        $stockTGK = DryAGradingHancuranStock::with('DryAOutputHancuran')->get();
        // return $stockTGK;
        return view('DryAHancuran.DryAOutput.create', compact('stockTGK', 'PreCleaningI', 'MasTujKir'));
    }
    public function set(Request $request)
    {
        $jenis_grading = $request->jenis_grading;
        $data = DryAGradingHancuranStock::where('jenis_grading', $jenis_grading)->get();

        // Kembalikan data sebagai respons JSON
        return response()->json($data);
    }


    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimDryA::where('tujuan_kirim',$tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = DryAGradingHancuranStock::whereIn('jenis_grading', $idBoxes)->pluck('jenis_grading')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $DryAOutputHancuranService;

    public function __construct(DryAOutputHancuranService $DryAOutputHancuranService)
    {
        $this->DryAOutputHancuranService = $DryAOutputHancuranService;
    }

    public function store(Request $request)
    {
        return $this->DryAOutputHancuranService->store($request);
    }
    public function destroy($nomor_job): RedirectResponse
    {
        return $this->DryAOutputHancuranService->destroy($nomor_job);
    }
}
