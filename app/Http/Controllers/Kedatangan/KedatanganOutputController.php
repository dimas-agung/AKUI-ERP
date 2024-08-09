<?php

namespace App\Http\Controllers\Kedatangan;

use App\Models\MasterBatch;
use Illuminate\Http\Request;
use App\Models\KedatanganOutput;
use App\Http\Controllers\Controller;
use App\Models\MasterJenisKedatangan;
use App\Services\KedatanganOutputService;
use App\Models\MasterTujuanKirimKedatangan;

class KedatanganOutputController extends Controller
{
    protected $KedatanganOutputService;

    public function __construct(KedatanganOutputService $KedatanganOutputService)
    {
        $this->KedatanganOutputService = $KedatanganOutputService;
    }
    //index
    public function index(Request $request)
    {
        $user = auth()->user()->plant;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = KedatanganOutput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(KedatanganOutput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $KedatanganOutput = $query->with('TransitKedatangan')->get();
        } else {
            $KedatanganOutput = KedatanganOutput::where('status', KedatanganOutput::STATUS_AKTIF)
                ->where('plant', '=', $user)
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('Kedatangan.KedatanganOutput.index', [
            'kedatangan_output' => $KedatanganOutput,
        ]);
    }

    //create
    public function create()
    {
        $user = auth()->user()->plant;
        $MasterBatch = MasterBatch::where('status', MasterBatch::STATUS_AKTIF)->get();
        $MasterJenisKedatangan = MasterJenisKedatangan::where('status', MasterJenisKedatangan::STATUS_AKTIF)->get();
        $MasterTujuanKirimKedatangan = MasterTujuanKirimKedatangan::where('status', MasterTujuanKirimKedatangan::STATUS_AKTIF)
            ->where('inisial_tujuan', '=', $user)
            ->get();
        return response()->view('Kedatangan.KedatanganOutput.create', [
            'master_batch'                      => $MasterBatch,
            'master_jenis_kedatangan'           => $MasterJenisKedatangan,
            'master_tujuan_kirim_kedatangan'    => $MasterTujuanKirimKedatangan,
        ]);
    }

    public function setBatch(Request $request)
    {
        $nomor_batch = $request->nomor_batch;
        $data =  MasterBatch::where('nomor_batch', $nomor_batch)->first();
        return response()->json($data);
    }

    public function setJenis(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisKedatangan::where('jenis', $jenis)->first();
        return response()->json($data);
    }

    public function setTujuanKirim(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        $data = MasterTujuanKirimKedatangan::where('tujuan_kirim', $tujuan_kirim)->first();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        return $this->KedatanganOutputService->store($request);
    }

    public function destroy($id)
    {
        return $this->KedatanganOutputService->destroy($id);
    }
}
