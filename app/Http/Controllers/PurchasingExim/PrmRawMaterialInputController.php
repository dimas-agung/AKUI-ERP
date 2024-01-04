<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
// use App\Models\PrmRawMaterialStock;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrmRawMaterialRequest;
use App\Http\Requests\PrmRawMaterialItemRequest;
use App\Models\MasterJenisRawMaterial;
use Illuminate\Http\Request;
use App\Models\MasterSupplierRawMaterial;
use Illuminate\Http\RedirectResponse;
use App\Services\PrmRawMaterialInputService;
use App\Services\PrmRawMaterialInputItemService;


class PrmRawMaterialInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->get();
        $PrmRawMaterialInput = PrmRawMaterialInput::with('MasterSupplierRawMaterial')->get();
        // return $PrmRawMaterialInput;
        // return $MasterSupplierRawMaterial;
        // return $MasterJenisRawMaterial;
        return response()->view('purchasing_exim.prm_raw_material_input.index', [
            'prm_raw_material_inputs'       => $PrmRawMaterialInput,
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
            'prm_raw_material_input_items'  => $PrmRawMaterialInputItem,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        return view('purchasing_exim/prm_raw_material_input.create', [
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
        ]);
    }

    // get Data Supplier
    public function getDataSupplier(Request $request)
    {
        $nama_supplier = $request->nama_supplier;
        // Lakukan logika untuk mengatur nomor batch berdasarkan id_box
        // $nomorBatch = $this->query('nomor_batch',$id_box);
        $data = MasterSupplierRawMaterial::where('nama_supplier', $nama_supplier)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    // get Data Jenis
    public function getDataJenis(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisRawMaterial::where('jenis', $jenis)->first();

        return response()->json($data);
    }

    public function simpanData(
        PrmRawMaterialRequest $request,
        PrmRawMaterialInputService $PrmRawMaterialInputService
    )
    // public function simpanData(Request $request)
    {
        $dataArray = json_decode($request->input('data'));
        // $dataStock = json_decode($request->input('dataStock'));
        $dataHeader = json_decode($request->input('dataHeader'));
        // $dataStockHistory = json_decode($request->input('dataStockHistory'));
        // $dataStockHistory = json_decode($request->input('dataStockHistory'));
        // return $dataArray;
        // var_dump($dataArray[0]);
        // return $dataStock;
        // return $dataHeader[0];
        // return $dataStockHistory[0];
        // Pastikan doc_no ada dan merupakan string sebelum menggunakan substr

        // $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray, $dataStock);
        $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray);
        // $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray, $dataStock, $dataStockHistory);

        // if (is_array($result) && isset($result['success']) && $result['success']) {
        //     return response()->json($result);
        // } else {
        //     return response()->json($result, 500);
        // }

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }
    // show
    public function show(string $id)
    {
        $i = 1;
        // $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        // $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        //get by ID
        $MasterPRIM = PrmRawMaterialInput::findOrFail($id);
        $items = $MasterPRIM->PrmRawMaterialInputItem;
        // return $MasterPRIM;


        return response()->view('purchasing_exim.prm_raw_material_input.show', compact('MasterPRIM', 'i'));
    }
    // edit
    // public function edit(string $id)
    // {
    //     $MasterPRIMI = PrmRawMaterialInputItem::findOrFail($id);
    //     // $PrmRawMaterialInput = PrmRawMaterialInput::findOrFail($id);
    //     $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
    //     $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
    //     // $MasterPRIM = PrmRawMaterialInput::with('PrmRawMaterialInputItem')
    //     //     ->where(['id' => $id])
    //     //     ->first();
    //     // return $MasterPRIMI;
    //     // return $PrmRawMaterialInput;
    //     return view('purchasing_exim.prm_raw_material_input.update', compact('MasterPRIMI', 'MasterJenisRawMaterial', 'MasterSupplierRawMaterial'));
    // }
    // destroy
    public function destroyInput($id): RedirectResponse
    {
        //get by ID
        $PrmRawMaterialInput = PrmRawMaterialInput::findOrFail($id);

        //delete
        $PrmRawMaterialInput->delete();

        //redirect to index
        return redirect()->route('prm_raw_material_input.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function destroyItem($id): RedirectResponse
    {
        //get by ID
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::findOrFail($id);

        //delete
        $PrmRawMaterialInputItem->delete();

        //redirect to index
        return redirect()->route('prm_raw_material_input.index')->with(['success' => 'Data Berhasil Dihapus!']);
        // return redirect()->route('prm_raw_material_input.show')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
