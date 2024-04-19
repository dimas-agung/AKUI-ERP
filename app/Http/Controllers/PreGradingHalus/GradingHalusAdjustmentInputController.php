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
    protected $GradingHalusAdjustmentInputService;
    protected $HppService;

    public function __construct(GradingHalusAdjustmentInputService $GradingHalusAdjustmentInputService, HppService $HppService)
    {
        $this->GradingHalusAdjustmentInputService = $GradingHalusAdjustmentInputService;
        $this->HppService = $HppService;
    }
    //index
    public function index()
    {
        $i = 1;
        $AdjustmentInput = GradingHalusAdjustmentInput::all();
        return response()->view('PreGradingHalus.AdjustmentInput.index', [
            'adjustment_inputs' => $AdjustmentInput,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        // $MasterJenisGradingHalus = MasterJenisGradingHalus::with('AdjustmentInput')->get();
        $MasterJenisGradingHalus = MasterJenisGradingHalus::all();
        $GradingHalusAdjustmentStock = GradingHalusAdjustmentStock::with('GradingHalusAdjustmentInput')->get();
        return view('PreGradingHalus.AdjustmentInput.create', [
            'grading_halus_adjustment_inputs' => $GradingHalusAdjustmentStock,
            'master_jenis_grading_halus' => $MasterJenisGradingHalus,
        ]);
    }

    // get data id Box
    public function getNomorAdjustment(Request $request)
    {
        $nomor_adjustment = $request->nomor_adjustment;
        $data = GradingHalusAdjustmentStock::where('nomor_adjustment', $nomor_adjustment)->first();

        return response()->json($data);
    }

    // get data id Box
    public function getJenisGradingHalus(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisGradingHalus::where('jenis', $jenis)->first();

        return response()->json($data);
    }
    // store
    public function store(Request $request)
    {
        return $this->GradingHalusAdjustmentInputService->store($request);
    }
    // destroy
    // public function destroy($id): RedirectResponse
    // {
    //     return $this->GradingHalusAdjustmentInputService->destroy($id);
    // }
    public function destroy($id): RedirectResponse
    {
        // Panggil fungsi hapusData dari GradingHalusAdjustmentInputService
        $result = $this->GradingHalusAdjustmentInputService->hapusData($id);

        // Periksa hasil panggilan fungsi hapusData
        if ($result['success']) {
            // Jika berhasil, redirect ke index dengan pesan sukses
            return redirect()->route('GradingHalusAdjustmentInput.index')->with('success', $result['message']);
        } else {
            // Jika gagal, redirect ke index dengan pesan error
            return redirect()->route('GradingHalusAdjustmentInput.index')->with('error', $result['error']);
        }
    }
}
