<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use App\Models\PreGradingHalusAdding;
use App\Models\PreGradingHalusStock;
use App\Services\PreGradingHalusAddingService;
use App\Http\Requests\PreGradingHalusAddingRequest;
use Illuminate\Http\Request;

class PreGradingHalusAddingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreGradingHalusAdding = PreGradingHalusAdding::all();
        return response()->view('PreGradingHalus.PreGradingHalusAdding.index', [
            'pre_grading_halus_addings' => $PreGradingHalusAdding,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreGradingHalusStock = PreGradingHalusStock::with('PreGradingHalusAdding')->get();
        return view('PreGradingHalus.PreGradingHalusAdding.create', [
            'pre_grading_halus_stocks' => $PreGradingHalusStock,
        ]);
    }
    // get Data Stock Grading Halus
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreGradingHalusStock::where('nomor_job', $nomor_job)->first();

        return response()->json($data);
    }
    // get Data Perusahaan
    public function getDataPerusahaan(Request $request)
    {
        $nama = $request->nama;
        $data = Perusahaan::where('nama', $nama)
            ->where('status', 1)
            ->first();

        return response()->json($data);
    }

    public function simpanData(
        PreGradingHalusAddingRequest $request,
        PreGradingHalusAddingService $PreGradingHalusAddingService
    ) {
        $dataArray = json_decode($request->input('data'));

        $result = $PreGradingHalusAddingService->simpanData($dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }
}
