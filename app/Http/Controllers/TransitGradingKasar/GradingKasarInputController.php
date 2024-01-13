<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradingKasarInputRequest;
use App\Models\GradingKasarInput;
use App\Models\StockTransitRawMaterial;
use App\Services\GradingKasarInputService;
use Illuminate\Http\Request;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class GradingKasarInputController extends Controller
{
    public function index(){
        $i =1;
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->get();
        $stockTGK = StockTransitRawMaterial::with('GradingKasarInput')->get();

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
        $stockTGK = StockTransitRawMaterial::with('PramRawMaterialOutputItems')->get();
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->get();
        // return $PrmRawMOIC;
        return view('transit_grading.GradingKasarInput.create', compact('stockTGK', 'GradingKI'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = StockTransitRawMaterial::where('nomor_bstb',$nomor_bstb)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function sendData(
        GradingKasarInputRequest $request,
        GradingKasarInputService $prmRawMaterialOutputService)
    { try {
        $dataArray = json_decode($request->input('data'));
        // $dataStock = json_decode($request->input('dataStock'));

        // Periksa apakah dekoding JSON berhasil
        if (!$dataArray) {
            throw new \InvalidArgumentException('Invalid JSON data.');
        }

        $result = $prmRawMaterialOutputService->sendData($dataArray);

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
     * edit
     */
    public function edit(string $id)
    {
        //get post by ID
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->find($id);
        $data = StockTransitRawMaterial::with('GradingKasarInput')->get();
        // return $GradingKI;

        //render view with post
        return view('transit_grading.GradingKasarInput.update', compact('GradingKI', 'data'));
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        $prmRawMaterialOutputService = app(GradingKasarInputService::class);

        // Lakukan sesuatu dengan layanan
        $result = $prmRawMaterialOutputService->updateItem($request, $id);

        // Lakukan sesuatu dengan hasil
        return $result;
    }

    /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $GradingKI = GradingKasarInput::findOrFail($id);

        //delete post
        $GradingKI->delete();

        //redirect to index
        return redirect()->route('GradingKasarInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
