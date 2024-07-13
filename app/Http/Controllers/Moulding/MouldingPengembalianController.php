<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\MouldingStock;
use App\Models\MouldingPenyebaran;
use App\Http\Controllers\Controller;
use App\Models\MouldingPengembalian;
use App\Services\MouldingPengembalianService;

class MouldingPengembalianController extends Controller
{
    protected $MouldingPengembalianService;

    public function __construct(MouldingPengembalianService $MouldingPengembalianService)
    {
        $this->MouldingPengembalianService = $MouldingPengembalianService;
    }
    //index
    public function index(Request $request)
    {
        // $i = 1;
        // $PreGHI = GradingHalusInput::with('PreGradingHalusAddingStock')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingPengembalian::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingPengembalian::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $MouldingPengembalian = $query->with('MouldingPenyebaran')->get();
        } else {
            $MouldingPengembalian = MouldingPengembalian::with('MouldingPenyebaran')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('Moulding.MouldingPengembalian.index', [
            'moulding_pengembalian' => $MouldingPengembalian,
            // 'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $MouldingStock = MouldingStock::where('status', 2)->get();
        return response()->view('Moulding.MouldingPengembalian.create', [
            'moulding_stock' => $MouldingStock,
        ]);
    }
    public function setJob(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = MouldingPenyebaran::where('nomor_job', $nomor_job)
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
        $unavailableBoxes = MouldingPenyebaran::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    public function store(Request $request)
    {
        return $this->MouldingPengembalianService->store($request);
    }


    public function destroy($nomor_job)
    {
        return $this->MouldingPengembalianService->destroy($nomor_job);
    }
}
