<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradingHalusAdjustmentAddingRequest;
use App\Models\GradingHalusAdjustmentAdding;
use App\Models\GradingHalusStock;
use App\Models\Perusahaan;
use App\Services\AdjustmentAddingService;
use App\Services\GradingHalusAdjustmentAddingService;
use Illuminate\Http\Request;

class GradingHalusAdjustmentAddingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $GradingHalusAdjustmentAdding = GradingHalusAdjustmentAdding::all();
        return response()->view('PreGradingHalus.AdjustmentAdding.index', [
            'grading_halus_adjustment_addings' => $GradingHalusAdjustmentAdding,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $GradingHalusStock = GradingHalusStock::with('GradingHalusAdjustmentAdding')->get();
        $Perusahaan = Perusahaan::all();
        return view('PreGradingHalus.AdjustmentAdding.create', [
            // 'pre_grading_halus_stocks' => $AdjustmentAdding,
            'grading_halus_stocks' => $GradingHalusStock,
            'perusahaan' => $Perusahaan,
        ]);
    }
    // get data id Box
    public function set(Request $request)
    {
        $id_box_grading_halus = $request->id_box_grading_halus;
        $data = GradingHalusStock::where('id_box_grading_halus', $id_box_grading_halus)->first();

        return response()->json($data);
    }

    //Simpan Data
    public function simpanData(
        GradingHalusAdjustmentAddingRequest $request,
        GradingHalusAdjustmentAddingService $GradingHalusAdjustmentAddingService
    ) {
        $dataArray = json_decode($request->input('data'));

        $result = $GradingHalusAdjustmentAddingService->simpanData($dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }

    //Hapus Data
    public function destroy($id, GradingHalusAdjustmentAddingService $GradingHalusAdjustmentAddingService)
    {
        $result = $GradingHalusAdjustmentAddingService->hapusData($id);

        if ($result['success']) {
            return redirect()->route('GradingHalusAdjustmentAdding.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('GradingHalusAdjustmentAdding.index')->with('error', 'Gagal menghapus data');
        }
    }
}
