<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Http\Requests\PreClaningInputRequest;
use App\Models\PreCleaningInput;
use App\Models\StockTransitGradingKasar;
use App\Services\PreClaningInputService;
use Illuminate\Http\Request;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PreCleaningInputController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $PreCleaningI = PreCleaningInput::with('StockTransitGradingKasar')->get();

        // return $GradingKI;
        return response()->view('PreCleaning.PreCleaningInput.index', [
            'PreCleaningI' => $PreCleaningI,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $PreCleaningI = PreCleaningInput::with('StockTransitGradingKasar')->get();
        $stockTGK = StockTransitGradingKasar::with('PreCleaningInput')->get();
        // return $PrmRawMOIC;
        return view('PreCleaning.PreCleaningInput.create', compact('stockTGK', 'PreCleaningI'));
    }

    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = StockTransitGradingKasar::where('nomor_job',$nomor_job)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

        // Contoh controller
        public function sendData(
            PreClaningInputRequest $request,
            PreClaningInputService $PreClaningInputService
        ) {
            try {
                // Mendapatkan data dari request
                $dataArray = $request->input('data');

                // Membuat array kosong untuk menyimpan data
                $formattedData = [];

                // Loop melalui setiap elemen data
                foreach ($dataArray as $data) {
                    // Format data sesuai kebutuhan
                    $formattedData[] = [
                        'doc_no' => $data['doc_no'],
                        'nomor_bstb' => $data['nomor_bstb'],
                        'id_box_grading_kasar' => $data['id_box_grading_kasar'],
                        'nomor_batch' => $data['nomor_batch'],
                        'nomor_job' => $data['nomor_job'],
                        'nama_supplier' => $data['nama_supplier'],
                        'nomor_nota_internal' => $data['nomor_nota_internal'],
                        'id_box_raw_material' => $data['id_box_raw_material'],
                        'jenis_raw_material' => $data['jenis_raw_material'],
                        'jenis_grading' => $data['jenis_grading'],
                        'berat_keluar' => $data['berat_keluar'],
                        'pcs_keluar' => $data['pcs_keluar'],
                        'avg_kadar_air' => $data['avg_kadar_air'],
                        'tujuan_kirim' => $data['tujuan_kirim'],
                        'nomor_grading' => $data['nomor_grading'],
                        'biaya_produksi' => $data['biaya_produksi'],
                        'modal' => $data['modal'],
                        'total_modal' => $data['total_modal'],
                        'fix_total_modal' => $data['fix_total_modal'],
                        'keterangan' => $data['keterangan'],
                    ];
                }

                // Mengirim data ke service
                $result = $PreClaningInputService->sendData($formattedData);

                // Periksa apakah pemrosesan berhasil
                if ($result['success']) {
                    return response()->json($result);
                } else {
                    return response()->json($result, 500);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

}
