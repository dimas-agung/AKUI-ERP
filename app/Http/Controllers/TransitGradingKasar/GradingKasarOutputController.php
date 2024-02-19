<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Models\StockTransitGradingKasar;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\GradingKasarOutput;
use Illuminate\Http\Request;
use App\Services\GradingKasarOutputService;
use App\Http\Requests\GradingKasarOutputRequest;
use App\Models\GradingKasarStock;
use App\Models\MasterTujuanKirimRawMaterial;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class GradingKasarOutputController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $GradingKO = GradingKasarOutput::all();
        // return $GradingKO;
        return response()->view('transit_grading.GradingKasarOutput.index', [
            'GradingKO' => $GradingKO,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $GradingKO = GradingKasarOutput::with('GradingKasarStock')->get();
        $MasTujKir = MasterTujuanKirimRawMaterial::with('PrmRawMaterialOutputItem')->get();
        $GradingKS = GradingKasarStock::with('GradingKasarOutput')->get();
        // return $PrmRawMOIC;
        return view('transit_grading.GradingKasarOutput.create', compact('GradingKO', 'GradingKS', 'MasTujKir'));
    }

    public function set(Request $request)
    {
        $id_box_grading_kasar = $request->id_box_grading_kasar;
        $data = GradingKasarStock::where('id_box_grading_kasar',$id_box_grading_kasar)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimRawMaterial::where('tujuan_kirim',$tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function sendData(
        GradingKasarOutputRequest $request,
        GradingKasarOutputService $GradingKasarOutputService)
         {
            try {
            $dataArray = json_decode($request->input('data'));
            // return $request->input('data');
            // $dataStock = json_decode($request->input('dataStock'));

            // Periksa apakah dekoding JSON berhasil
            if (!$dataArray) {
                throw new \InvalidArgumentException('Invalid JSON data.');
            }

            $result = $GradingKasarOutputService->sendData($dataArray);

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

        /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $GradingKO = GradingKasarOutput::findOrFail($id);
        $stockPRM = StockTransitGradingKasar::where('id_box_raw_material', '=', $GradingKO->id_box_raw_material)
        ->where('created_at', $GradingKO->created_at)
        ->first();

        // Ambil data StockTransitRawMaterial berdasarkan nomor_bstb
        $stockGradingKasar = GradingKasarStock::where('id_box_raw_material', '=', $GradingKO->id_box_raw_material)->first();

        if ($stockGradingKasar) {
            // Simpan nilai sebelum dihapus
            $beratTadi = $GradingKO->berat_keluar;
            $beratSebelumnya = $stockGradingKasar->berat_keluar;
            $PcsTadi = $GradingKO->pcs_keluar;
            $PcsSebelumnya = $stockGradingKasar->pcs_keluar;
            $Modal = $GradingKO->modal;

            $Beratkeluar = $beratSebelumnya - $beratTadi;
            $PcsKeluar = $PcsSebelumnya - $PcsTadi;
            $TotalModal = $Beratkeluar * $Modal;

            // Update data pada PrmRawMaterialStock
            $dataToUpdate = [
                'berat_keluar' => $Beratkeluar,
                'pcs_keluar' => $PcsKeluar,
                'total_modal' => $TotalModal,
            ];

            // Perbarui data pada PrmRawMaterialStock
            $stockGradingKasar->update($dataToUpdate);
        }

        //delete post
        $GradingKO->delete();
        $stockPRM->delete();

        //redirect to index
        return redirect()->route('GradingKasarOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
