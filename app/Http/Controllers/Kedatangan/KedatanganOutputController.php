<?php

namespace App\Http\Controllers\Kedatangan;

use App\Http\Controllers\Controller;
use App\Models\KedatanganOutput;
use App\Models\MasterBatch;
use App\Models\MasterJenisKedatangan;
use App\Models\MasterTujuanKirimKedatangan;
use Illuminate\Http\Request;

class KedatanganOutputController extends Controller
{
    //index
    public function index()
    {
        $KedatanganOutput = KedatanganOutput::all();
        return response()->view('Kedatangan.KedatanganOutput.index', [
            'kedatangan_output' => $KedatanganOutput,
        ]);
    }
    //create
    public function create()
    {
        $MasterBatch = MasterBatch::where('status', MasterBatch::STATUS_AKTIF)->get();
        $MasterJenisKedatangan = MasterJenisKedatangan::where('status', MasterJenisKedatangan::STATUS_AKTIF)->get();
        $MasterTujuanKirimKedatangan = MasterTujuanKirimKedatangan::where('status', MasterTujuanKirimKedatangan::STATUS_AKTIF)->get();
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
}
