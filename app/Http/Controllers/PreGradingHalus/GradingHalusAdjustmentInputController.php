<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\GradingHalusAdjustmentInput;
use App\Models\GradingHalusAdjustmentStock;
use App\Models\MasterJenisGradingHalus;
use App\Services\GradingHalusAdjustmentInputService;
use App\Services\HppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GradingHalusAdjustmentInputController extends Controller
{
    protected $GradingHalusAdjustmentInput = null;
    protected $GradingHalusAdjustmentStock = null;
    protected $MasterJenisGradingHalus = null;
    protected $GradingHalusAdjustmentInputService;
    protected $HppService;

    public function getGradingHalusAdjustmentInput()
    {
        if ($this->GradingHalusAdjustmentInput === null) {
            $this->GradingHalusAdjustmentInput = GradingHalusAdjustmentInput::all();
        }
        return $this->GradingHalusAdjustmentInput;
    }

    public function getGradingHalusAdjustmentStock()
    {
        if ($this->GradingHalusAdjustmentStock === null) {
            $this->GradingHalusAdjustmentStock = GradingHalusAdjustmentStock::where('status', 1)->get();
        }
        return $this->GradingHalusAdjustmentStock;
    }

    public function getMasterJenisGradingHalus()
    {
        if ($this->MasterJenisGradingHalus === null) {
            $this->MasterJenisGradingHalus = MasterJenisGradingHalus::where('status', 1)->get();
        }
        return $this->MasterJenisGradingHalus;
    }

    public function __construct(GradingHalusAdjustmentInputService $GradingHalusAdjustmentInputService, HppService $HppService)
    {
        $this->GradingHalusAdjustmentInputService = $GradingHalusAdjustmentInputService;
        $this->HppService = $HppService;
    }
    //index
    public function index(Request $request)
    {
        $i = 1;
        // $AdjustmentInput = GradingHalusAdjustmentInput::all();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingHalusAdjustmentInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingHalusAdjustmentInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $AdjustmentInput = $query->get();
        }else{
            $AdjustmentInput = GradingHalusAdjustmentInput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('PreGradingHalus.AdjustmentInput.index', [
            'adjustment_inputs' => $this->getGradingHalusAdjustmentInput(),
        ]);
    }
    // create
    public function create()
    {
        // $MasterJenisGradingHalus = MasterJenisGradingHalus::with('AdjustmentInput')->get();
        $MasterJenisGradingHalus = MasterJenisGradingHalus::where('status',1)->get();
        $GradingHalusAdjustmentStock = GradingHalusAdjustmentStock::with('GradingHalusAdjustmentInput')->where('status',1)->get();
        return view('PreGradingHalus.AdjustmentInput.create', [
            'grading_halus_adjustment_inputs' => $GradingHalusAdjustmentStock,
            'master_jenis_grading_halus' => $MasterJenisGradingHalus,
        ]);
    }

    // get data id Box
    public function getNomorAdjustment(Request $request)
    {
        $nomor_adjustment = $request->nomor_adjustment;
        $data = $this->getGradingHalusAdjustmentStock()->where('nomor_adjustment', $nomor_adjustment)->first();

        return response()->json($data);
    }

    // get data id Box
    public function getJenisGradingHalus(Request $request)
    {
        $jenis = $request->jenis;
        $data = $this->getMasterJenisGradingHalus()->where('jenis', $jenis)->first();

        return response()->json($data);
    }
    // store
    public function store(Request $request)
    {
        return $this->GradingHalusAdjustmentInputService->store($request);
    }
    public function destroy($id, GradingHalusAdjustmentInputService $GradingHalusAdjustmentInputService)
    {
        return $GradingHalusAdjustmentInputService->destroy($id);
    }
}
