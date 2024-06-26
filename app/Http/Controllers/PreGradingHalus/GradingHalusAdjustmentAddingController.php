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
    protected $GradingHalusAdjustmentAdding = null;
    protected $GradingHalusStock = null;
    protected $Perusahaan = null;

    public function getGradingHalusAdjustmentAdding()
    {
        if ($this->GradingHalusAdjustmentAdding === null) {
            $this->GradingHalusAdjustmentAdding = GradingHalusAdjustmentAdding::all();
        }
        return $this->GradingHalusAdjustmentAdding;
    }

    public function getGradingHalusStock()
    {
        if ($this->GradingHalusStock === null) {
            $this->GradingHalusStock = GradingHalusStock::where('sisa_berat', '!=', 0)->get();
        }
        return $this->GradingHalusStock;
    }
    public function getPerusahaan()
    {
        if ($this->Perusahaan === null) {
            $this->Perusahaan = Perusahaan::where('status', 1)->get();
        }
        return $this->Perusahaan;
    }
    //index
    public function index(Request $request)
    {
        $i = 1;

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = GradingHalusAdjustmentAdding::query();


        if ($startDate && $endDate) {
            $query->whereBetween(GradingHalusAdjustmentAdding::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $GradingHalusAdjustmentAdding = $query->get();
        }else{
            $GradingHalusAdjustmentAdding = GradingHalusAdjustmentAdding::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('PreGradingHalus.AdjustmentAdding.index', [
            'grading_halus_adjustment_addings' => $this->getGradingHalusAdjustmentAdding(),
        ]);
    }
    // create
    public function create()
    {
        return view('PreGradingHalus.AdjustmentAdding.create', [
            // 'pre_grading_halus_stocks' => $AdjustmentAdding,
            'grading_halus_stocks' => $this->getGradingHalusStock(),
            'perusahaan' => $this->getPerusahaan(),
        ]);
    }
    // get data id Box
    public function set(Request $request)
    {
        $id_box_grading_halus = $request->id_box_grading_halus;
        $data = $this->getGradingHalusStock()->where('id_box_grading_halus', $id_box_grading_halus)->first();

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

    // Hapus Data
    public function destroy($id, GradingHalusAdjustmentAddingService $GradingHalusAdjustmentAddingService)
    {
        $result = $GradingHalusAdjustmentAddingService->destroy($id);

        if ($result['success']) {
            return redirect()->route('GradingHalusAdjustmentAdding.index')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('GradingHalusAdjustmentAdding.index')->with('error', 'Gagal menghapus data: ' . $result['error']);
        }
    }
}
