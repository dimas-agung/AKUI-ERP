<?php

namespace App\Http\Controllers\DryA;

use App\Services\HppService;
use Illuminate\Http\Request;
use App\Models\MasterJenisDryA;
use App\Models\DryAGradingCabut;
use App\Http\Controllers\Controller;
use App\Models\DryAGradingCabutStock;
use Illuminate\Http\RedirectResponse;
use App\Models\DryAPenerimaanCabutStock;
use App\Services\DryAGradingCabutService;
use Illuminate\Support\Facades\Auth;

class DryAGradingCabutController extends Controller
{
    //index
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DryAGradingCabut::query();


        if ($startDate && $endDate) {
            $query->whereBetween(DryAGradingCabut::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $DryAGradingCabut = $query->with('DryAPenerimaanCabutStock')->get();
        } else {
            $DryAGradingCabut = DryAGradingCabut::with('DryAPenerimaanCabutStock')
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('DryA.DryAGradingCabut.index', [
            'dry_a_grading_cabut' => $DryAGradingCabut,
        ]);
    }

    // create
    public function create()
    {
        $DryAPenerimaanCabutStock = DryAPenerimaanCabutStock::withCount('DryAGradingCabut')->where('tujuan_kirim',Auth::user()->plant)->where('status',1)->get();
        $MasterJenisDryA = MasterJenisDryA::where('status', 1)->get();
        // return $DryAPenerimaanCabutStock;
        return response()->view('DryA.DryAGradingCabut.create', [
            'dry_a_penerimaan_cabut_stock' => $DryAPenerimaanCabutStock,
            'master_jenis_dry_a' => $MasterJenisDryA,
        ]);
    }
    public function create_trial()
    {
        $DryAPenerimaanCabutStock = DryAPenerimaanCabutStock::withCount('DryAGradingCabut')->where('tujuan_kirim',Auth::user()->plant)->where('status',1)->get();
        $MasterJenisDryA = MasterJenisDryA::where('status', 1)->get();
        // return $DryAPenerimaanCabutStock;
        return response()->view('DryA.DryAGradingCabut.create_trial', [
            'dry_a_penerimaan_cabut_stock' => $DryAPenerimaanCabutStock,
            'master_jenis_dry_a' => $MasterJenisDryA,
        ]);
    }

    // set Nomor Job
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = DryAPenerimaanCabutStock::where('nomor_job', $nomor_job)->first();
        return response()->json($data);
    }

    // set Master Jenis
    public function setJenis(Request $request)
    {
        $jenis_grading = $request->jenis_grading;
        $data = MasterJenisDryA::where('jenis', $jenis_grading)->first();
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);

        // Cek ketersediaan id box dalam database
        $unavailableBoxes = DryAPenerimaanCabutStock::whereIn('nomor_job', $idBoxes)->pluck('nomor_job')->toArray();

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    protected $DryAGradingCabutService;

    public function __construct(DryAGradingCabutService $DryAGradingCabutService, HppService $HppService)
    {
        $this->DryAGradingCabutService = $DryAGradingCabutService;
    }

    public function store(Request $request)
    {
        return $this->DryAGradingCabutService->store($request);
    }

    public function destroy($nomor_job): RedirectResponse
    {
        return $this->DryAGradingCabutService->destroy($nomor_job);
    }

    public function getJenisGradings(Request $request){
        $jenis = $request->input('jenis');

        if (is_array($jenis)) {

            return  MasterJenisDryA::whereIn('jenis',$jenis)->get();
        }
        return  MasterJenisDryA::where('jenis',$jenis)->first();
    }
}
