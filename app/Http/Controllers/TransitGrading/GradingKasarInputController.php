<?php

namespace App\Http\Controllers\TransitGrading;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarInput;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class GradingKasarInputController extends Controller
{
    public function index(){
        $i =1;
        $GradingKI = GradingKasarInput::with('StockTransitGradingKasar')->get();
        $stockTGK = StockTransitGradingKasar::with('GradingKasarInput')->get();
        // return $GradingKI;
        return response()->view('transit_grading.GradingKasarInput.index', [
            'GradingKI' => $GradingKI,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $stockTGK = StockTransitGradingKasar::with('PramRawMaterialOutputItems')->get();
        $GradingKI = GradingKasarInput::with('GradingKasarInput')->get();
        // return $PrmRawMOIC;
        return view('transit_grading.GradingKasarInput.create', compact('stockTGK', 'GradingKI'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        // Lakukan logika untuk mengatur nomor batch berdasarkan nomor_bstb
        $data = StockTransitGradingKasar::where('nomor_bstb',$nomor_bstb)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // // Contoh controller
    // public function sendData(
    //     PrmRawMaterialOutputRequest $request,
    //     PrmRawMaterialOutputService $prmRawMaterialOutputService)
    // { try {
    //     $dataArray = json_decode($request->input('data'));
    //     // $dataStock = json_decode($request->input('dataStock'));

    //     // Periksa apakah dekoding JSON berhasil
    //     if (!$dataArray) {
    //         throw new \InvalidArgumentException('Invalid JSON data.');
    //     }

    //     $result = $prmRawMaterialOutputService->sendData($dataArray);

    //     // Periksa apakah pemrosesan berhasil
    //     if ($result['success']) {
    //         return response()->json($result);
    //     } else {
    //         return response()->json($result, 500);
    //     }
    // } catch (\Exception $e) {
    //     return response()->json(['error' => $e->getMessage()], 500);
    // }
    // }

    // /**
    //  * edit
    //  */
    // public function edit(string $id)
    // {
    //     //get post by ID
    //     $PrmRawMOIC = PrmRawMaterialOutputItem::with('PrmRawMaterialStock')->find($id);
    //     $PrmRawMO = PrmRawMaterialOutputItem::with('PrmRawMaterialStock')->find($id);
    //     $MasTujKir = MasterTujuanKirimRawMaterial::with('PrmRawMaterialOutputItem')->get();
    //     $PrmRawMS = PrmRawMaterialStock::with('PrmRawMaterialOutputItem')->get();
    //     // return $PrmRawMO;
    //     // Pastikan $PrmRawMO tidak null sebelum mengakses propertinya
    //     if ($PrmRawMO !== null) {
    //         // Mengakses berat_masuk dari relasi PrmRawMaterialStock
    //         $beratMasuk = optional($PrmRawMO->PrmRawMaterialStock)->berat_masuk;
    //         $sisaberat = optional($PrmRawMO->PrmRawMaterialStock)->sisa_berat;

    //         // Rest of your code...
    //     } else {
    //         // Handle case when the record with the given $id is not found
    //     }

    //     //render view with post
    //     return view('purchasing_exim.PrmRawMaterialOutput.update', compact('PrmRawMOIC', 'PrmRawMS', 'beratMasuk', 'sisaberat', 'PrmRawMO', 'MasTujKir'));
    // }

    // /**
    //  * update
    //  */
    // public function update(Request $request, $id)
    // {
    //     $prmRawMaterialOutputService = app(PrmRawMaterialOutputService::class);

    //     // Lakukan sesuatu dengan layanan
    //     $result = $prmRawMaterialOutputService->updateItem($request, $id);

    //     // Lakukan sesuatu dengan hasil
    //     return $result;
    // }

    /**
     * destroy
     */
    // public function destroy($id): RedirectResponse
    // {
    //     //get post by ID
    //     $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
    //     $PrmRawMO = PrmRawMaterialOutputItem::with('PrmRawMaterialStock')->find($id);

    //     //delete post
    //     $PrmRawMO->delete();

    //     //redirect to index
    //     return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    // }
}
