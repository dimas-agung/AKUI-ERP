<?php

namespace App\Http\Controllers\PreWash;

use App\Http\Controllers\Controller;
use App\Models\MasterOperator;
use App\Models\PreWashOutput;
use App\Models\PreWashStock;
use App\Models\TransitPreWash;
use App\Services\PreWashOutputService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PreWashOutputController extends Controller
{
    public function index()
    {
        $i = 1;
        $PreCleaningOutput = PreWashOutput::all();
        return response()->view('PreWash.PreWashOutput.index', [
            'pre_cleaning_outputs' => $PreCleaningOutput,
            'i' => $i,
        ]);
    }

    public function create()
    {
        $PreWashO = PreWashOutput::with('PreWashStock')->get();
        $PreWashStk = PreWashStock::with('PreWashOutput')->get();
        // $TransitPreW = TransitPreWash::with('PreWashOutput')->get();
        $MasterO = MasterOperator::with('PreWashOutput')->get();
        // return $TujuanKirimGHI;
        return view('PreWash.PreWashOutput.create', compact('PreWashO', 'PreWashStk', 'MasterO'));
    }

    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreWashStock::where('nomor_job', $nomor_job)
            ->whereRaw('berat_job != 0') // Tambahkan kondisi ini
            ->first();
        // return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }

    protected $PreWashOutputService;

    public function __construct(PreWashOutputService $PreWashOutputService)
    {
        $this->PreWashOutputService = $PreWashOutputService;
    }

    public function store(Request $request)
    {
        return $this->PreWashOutputService->store($request);
    }
    public function destroy($nomor_bstb): RedirectResponse
    {
        return $this->PreWashOutputService->destroy($nomor_bstb);
    }
}
