<?php

namespace App\Http\Controllers\FinalGrading;

use App\Models\FinalGrading;
use Illuminate\Http\Request;
use App\Models\TransitMoulding;
use App\Http\Controllers\Controller;
use App\Models\TransitMouldingRework;
use App\Services\FinalGradingService;
use App\Models\MasterJenisFinalGrading;

class FinalGradingController extends Controller
{
    protected $FinalGradingService;

    public function __construct(FinalGradingService $FinalGradingService)
    {
        $this->FinalGradingService = $FinalGradingService;
    }
    //index
    public function index()
    {
        $FinalGrading = FinalGrading::where('status', FinalGrading::STATUS_AKTIF)->get();
        return response()->view('FinalGrading.FinalGrading.index', [
            'final_grading' => $FinalGrading,
        ]);
    }
    // create
    public function create()
    {
        $TransitMoulding =  TransitMoulding::where('status', TransitMoulding::STATUS_AKTIF)->get();
        $TransitMouldingRework =  TransitMouldingRework::where('status', TransitMouldingRework::STATUS_AKTIF)->get();
        $MasterJenisFinalGrading =  MasterJenisFinalGrading::where('status', MasterJenisFinalGrading::STATUS_AKTIF)->get();
        // return $TransitMouldingRework;
        return view('FinalGrading.FinalGrading.create', [
            'transit_moulding'              => $TransitMoulding,
            'transit_moulding_rework'       => $TransitMouldingRework,
            'master_jenis_final_grading'    => $MasterJenisFinalGrading,
        ]);
    }
    // get data transit moulding
    public function getMoulding()
    {
        $data = TransitMoulding::where('status', TransitMoulding::STATUS_AKTIF)->get();
        return response()->json($data);
    }
    // get data transit moulding rework
    public function getRework()
    {
        $data = TransitMouldingRework::where('status', TransitMouldingRework::STATUS_AKTIF)->get();
        return response()->json($data);
    }
    // set transit moulding
    public function setMoulding(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = TransitMoulding::where('nomor_job', $nomor_job)->first();
        return response()->json($data);
    }
    // set transit moulding rework
    public function setRework(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = TransitMouldingRework::where('nomor_job_rework', $nomor_job)->first();
        return response()->json($data);
    }
    // set transit moulding rework
    public function setJenis(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisFinalGrading::where('jenis', $jenis)->first();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        return $this->FinalGradingService->store($request);
    }

    public function destroy($id)
    {
        return $this->FinalGradingService->destroy($id);
    }
}
