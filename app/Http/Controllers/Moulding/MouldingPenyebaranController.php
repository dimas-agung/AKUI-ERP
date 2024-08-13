<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\MouldingStock;
use App\Models\MasterOperator;
use App\Models\MouldingPenyebaran;
use App\Http\Controllers\Controller;
use App\Services\MouldingPenyebaranService;
use Illuminate\Support\Facades\Auth;

class MouldingPenyebaranController extends Controller
{
    protected $MouldingPenyebaranService;

    public function __construct(MouldingPenyebaranService $MouldingPenyebaranService)
    {
        $this->MouldingPenyebaranService = $MouldingPenyebaranService;
    }
    //index
    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingPenyebaran::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingPenyebaran::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $MouldingPenyebaran = $query->with('MouldingStock')->where('tujuan_kirim',Auth::user()->plant)->get();
        } else {
            $MouldingPenyebaran = MouldingPenyebaran::with('MouldingStock')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->where('tujuan_kirim',Auth::user()->plant)
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('Moulding.MouldingPenyebaran.index', [
            'moulding_penyebaran' => $MouldingPenyebaran,
            // 'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $MouldingStock = MouldingStock::where('status', 1)->where('tujuan_kirim',Auth::user()->plant)->get();
        $MasterOperator = MasterOperator::where('status', 1)->get();
        return response()->view('Moulding.MouldingPenyebaran.create', [
            'moulding_stock' => $MouldingStock,
            'master_operator' => $MasterOperator,
        ]);
    }
    public function setJob(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = MouldingStock::where('nomor_job', $nomor_job)
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }
    public function setNip(Request $request)
    {
        $nip = $request->nip;
        $data = MasterOperator::where('nip', $nip)
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = MouldingStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->MouldingPenyebaranService->store($request);
    }


    public function destroy($nomor_job)
    {
        return $this->MouldingPenyebaranService->destroy($nomor_job);
    }
}
