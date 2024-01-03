<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
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

    public function createItem()
    {
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        return view('purchasing_exim/prm_raw_material_input.create_item', [
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
        $dataHeader = json_decode($request->input('dataHeader'));
        $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }
    // public function store(Request $request): RedirectResponse
    // {
    //     //validate form
    //     $this->validate($request, [
    // 'doc_no.*',
    // 'nomor_po'               => 'required',
    // 'nomor_batch'            => 'required',
    // 'nomor_nota_supplier'    => 'required',
    // 'nomor_nota_internal'    => 'required',
    // 'nama_supplier'          => 'required',
    // 'jenis'                  => 'required',
    // 'berat_nota'             => 'required',
    // 'berat_kotor'            => 'required',
    // 'berat_bersih'           => 'required',
    // 'selisih_berat'          => 'required',
    // 'kadar_air'              => 'required',
    // 'id_box'                 => 'required',
    // 'harga_nota'             => 'required',
    // 'total_harga_nota'       => 'required',
    // 'harga_deal'             => 'required',
    // 'keterangan',
    // 'user_created',
    // 'user_updated',
    //     ]);

    //     //create Purchasing Raw Material Input
    //     PrmRawMaterialInput::create([
    //         'doc_no'                => $request->doc_no,
    //         'nomor_po'              => $request->nomor_po,
    //         'nomor_batch'           => $request->nomor_batch,
    //         'nomor_nota_supplier'   => $request->nomor_nota_supplier,
    //         'nomor_nota_internal'   => $request->nomor_nota_internal,
    //         'nama_supplier'         => $request->nama_supplier,
    //         'keterangan'            => $request->keterangan,
    //         'user_created'          => $request->user_created,
    //         'user_updated'          => $request->user_updated
    //     ]);
    //     //create Purchasing Raw Material Item
    //     PrmRawMaterialInputItem::create([
    //         'doc_no'                => $request->doc_no,
    //         'jenis'                 => $request->jenis,
    //         'berat_nota'            => $request->berat_nota,
    //         'berat_kotor'           => $request->berat_kotor,
    //         'berat_bersih'          => $request->berat_bersih,
    //         'selisih_berat'         => $request->selisih_berat,
    //         'kadar_air'             => $request->kadar_air,
    //         'id_box'                => $request->id_box,
    //         'harga_nota'            => $request->harga_nota,
    //         'total_harga_nota'      => $request->total_harga_nota,
    //         'harga_deal'            => $request->harga_deal,
    //         'keterangan'            => $request->keterangan,
    //         'user_created'          => $request->user_created,
    //         'user_updated'          => $request->user_updated
    //     ]);

    //     //redirect to index
    //     return redirect()->route('prm_raw_material_input.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }
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

        return response()->view('purchasing_exim.prm_raw_material_input.show', compact('MasterPRIM', 'items', 'i'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterPRIMI = PrmRawMaterialInputItem::findOrFail($id);
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        return view('purchasing_exim.prm_raw_material_input.update', compact('MasterPRIMI', 'MasterJenisRawMaterial', 'MasterSupplierRawMaterial'));
    }    public function destroyInput($id): RedirectResponse
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
