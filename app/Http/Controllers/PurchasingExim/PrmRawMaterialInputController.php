<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterSupplierRawMaterial;
use Illuminate\Http\RedirectResponse;

class PrmRawMaterialInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $PrmRawMaterialInput = PrmRawMaterialInput::all();
        // return $PrmRawMaterialInput;
        return response()->view('purchasing_exim.prm_raw_material_input.index', [
            'prm_raw_material_inputs'       => $PrmRawMaterialInput,
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'doc_no'                => 'required',
            'nomor_po'              => 'required',
            'nomor_batch'           => 'required',
            'nomor_nota_supplier'   => 'required',
            'nomor_nota_internal'   => 'required',
            'nama_supplier'         => 'required',
            'keterangan'            => 'required',
            'user_created'          => 'required'
        ]);

        //create MasterSupplier
        MasterSupplierRawMaterial::create([
            'doc_no'                => $request->doc_no,
            'nomor_po'              => $request->nomor_po,
            'nomor_batch'           => $request->nomor_batch,
            'nomor_nota_supplier'   => $request->nomor_nota_supplier,
            'nomor_nota_internal'   => $request->nomor_nota_internal,
            'nama_supplier'         => $request->nama_supplier,
            'keterangan'            => $request->keterangan,
            'user_created'          => $request->user_created
        ]);

        //redirect to index
        return redirect()->route('prm_raw_material_input.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
