<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreCleaningOutputRequest;
use App\Models\MasterOperator;
use App\Models\PreCleaningOutput;
use App\Models\PreCleaningStock;
use App\Models\TransitPreCleaningStock;
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
        return response()->view('PreCleaning.PreCleaningOutput.index', [
            'pre_cleaning_outputs' => $PreCleaningOutput,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreCleaningStock = PreCleaningStock::with('PreCleaningOutput')->get();
        $PreCleaningOutput = PreCleaningOutput::with('PreCleaningStock')->whereRaw('berat_masuk - berat_keluar != 0');
        $MasterOperator = MasterOperator::with('PreCleaningOutput')->get();
        return view('PreCleaning.PreCleaningOutput.create', [
            'pre_cleaning_outputs'      => $PreCleaningOutput,
            'pre_cleaning_stocks'       => $PreCleaningStock,
            'master_operators'          => $MasterOperator,
        ]);
    }
    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreCleaningStock::where('nomor_job', $nomor_job)
            ->whereRaw('berat_masuk - berat_keluar != 0') // Tambahkan kondisi ini
            ->first();
        return $data;
        // Kembalikan nomor job sebagai respons
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
            // $TransitPreCleaningStock = TransitPreCleaningStock::findOrFail($id)
            // Hapus semua item terkait
            $PreCleaningOutput->TransitPreCleaningStock()->delete();
            // Hapus record utama
            $PreCleaningOutput->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('PreCleaningOutput.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('PreCleaningOutput.index')->with('error', 'Gagal menghapus data');
        }
    }
}
