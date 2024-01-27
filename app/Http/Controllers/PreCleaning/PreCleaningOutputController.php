<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreCleaningOutputRequest;
use App\Models\MasterOperator;
use App\Models\PreCleaningOutput;
use App\Models\PreCleaningStock;
use App\Services\PreCleaningOutputService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PreCleaningOutputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreCleaningOutput = PreCleaningOutput::all();
        return response()->view('pre_cleaning.pre_cleaning_output.index', [
            'pre_cleaning_outputs' => $PreCleaningOutput,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreCleaningStock = PreCleaningStock::with('PreCleaningOutput')->get();
        $PreCleaningOutput = PreCleaningOutput::with('PreCleaningStock')->get();
        $MasterOperator = MasterOperator::with('PreCleaningOutput')->get();
        return view('pre_cleaning.pre_cleaning_output.create', [
            'pre_cleaning_outputs'      => $PreCleaningOutput,
            'pre_cleaning_stocks'       => $PreCleaningStock,
            'master_operators'          => $MasterOperator,
        ]);
    }
    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreCleaningStock::where('nomor_job', $nomor_job)->first();
        return $data;
        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function simpanData(
        PreCleaningOutputRequest $request,
        PreCleaningOutputService $PreCleaningOutputService
    ) {
        $dataArray = json_decode($request->input('data'));

        $result = $PreCleaningOutputService->simpanData($dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Temukan record berdasarkan ID
            $PreCleaningOutput = PreCleaningOutput::findOrFail($id);

            // Hapus record utama
            $PreCleaningOutput->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('pre_cleaning_output.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('pre_cleaning_output.index')->with('error', 'Gagal menghapus data');
        }
    }
}
