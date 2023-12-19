<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Http\Controllers\Controller;
use App\Models\MasterJenisRawMaterial;
use Illuminate\Http\Request;
use App\Models\MasterSupplierRawMaterial;
use Database\Seeders\MasterJenisRawMaterialSeeder;
use Illuminate\Http\RedirectResponse;

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
        return response()->view('purchasing_exim.prm_raw_material_input.form', [
            'prm_raw_material_inputs'       => $PrmRawMaterialInput,
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
            'prm_raw_material_input_items'  => $PrmRawMaterialInputItem,
            'i' => $i,
        ]);
    }
    public function getDataSupplier(Request $request)
    {
        $nama_supplier = $request->nama_supplier;
        // Lakukan logika untuk mengatur nomor batch berdasarkan id_box
        // $nomorBatch = $this->query('nomor_batch',$id_box);
        $data = MasterSupplierRawMaterial::where('nama_supplier', $nama_supplier)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'doc_no.*'               => 'required|unique',
            'nomor_po'               => 'required',
            'nomor_batch'          => 'required',
            'nomor_nota_supplier'  => 'required',
            'nomor_nota_internal'  => 'required',
            'nama_supplier'        => 'required',
            'jenis'                  => 'required',
            'berat_nota'             => 'required',
            'berat_kotor'            => 'required',
            'berat_bersih'           => 'required',
            'selisih_berat'          => 'required',
            'kadar_air'              => 'required',
            'id_box'                 => 'required',
            'harga_nota'             => 'required',
            'total_harga_nota'       => 'required',
            'harga_deal'             => 'required',
            'keterangan',
            'keterangan_item',
            'user_created',
            'user_updated',
        ]);

        //create Purchasing Raw Material Input
        PrmRawMaterialInput::create([
            'doc_no'                => $request->doc_no,
            'nomor_po'              => $request->nomor_po,
            'nomor_batch'           => $request->nomor_batch,
            'nomor_nota_supplier'   => $request->nomor_nota_supplier,
            'nomor_nota_internal'   => $request->nomor_nota_internal,
            'nama_supplier'         => $request->nama_supplier,
            'keterangan'            => $request->keterangan,
            'user_created'          => $request->user_created,
            'user_updated'          => $request->user_updated
        ]);
        //create Purchasing Raw Material Item
        PrmRawMaterialInputItem::create([
            'doc_no'                => $request->doc_no,
            'jenis'                 => $request->jenis,
            'berat_nota'            => $request->berat_nota,
            'berat_kotor'           => $request->berat_kotor,
            'berat_bersih'          => $request->berat_bersih,
            'selisih_berat'         => $request->selisih_berat,
            'kadar_air'             => $request->kadar_air,
            'id_box'                => $request->id_box,
            'harga_nota'            => $request->harga_nota,
            'total_harga_nota'      => $request->total_harga_nota,
            'harga_deal'            => $request->harga_deal,
            'keterangan_item'       => $request->keterangan_item,
            'user_created'          => $request->user_created,
            'user_updated'          => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('prm_raw_material_input.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
