<?php

namespace App\Http\Controllers;

use App\Models\MasterSupplierRawMaterial;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterSupplierRawMaterialController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::all();
        // return $MasterSupplier;
        return response()->view('master.master_supplier_raw_material.index', [
            'MasterSupplierRawMaterial' => $MasterSupplierRawMaterial,
            'i' => $i
        ]);
    }
    // create
    public function create()
    {
        return view('master.master_supplier_raw_material.create');
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama_supplier'             => 'required|unique:master_supplier_raw_materials',
            'inisial_supplier'          => 'required|unique:master_supplier_raw_materials'
        ], [
            'nama_supplier.required'    => 'Kolom Nama Supplier Wajib diisi.',
            'inisial_supplier.required' => 'Kolom Inisial Supplier Wajib diisi.',
        ]);

        //create MasterSupplier
        MasterSupplierRawMaterial::create([
            'nama_supplier'             => $request->nama_supplier,
            'inisial_supplier'          => $request->inisial_supplier
        ]);

        //redirect to index
        return redirect()->route('master_supplier_raw_material.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // show
    public function show(string $id)
    {
        //get by ID
        $MasterSPR = MasterSupplierRawMaterial::findOrFail($id);

        //render view
        return view('master.master_supplier_raw_material.show', compact('MasterSPR'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterSPR = MasterSupplierRawMaterial::findOrFail($id);

        return view('master.master_supplier_raw_material.update', compact('MasterSPR'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterSPR = MasterSupplierRawMaterial::findOrFail($id);
        $validasiNamaSuppllier = 'required';
        $validasiInitialSuppllier = 'required';
        if ($request->nama_supplier != $MasterSPR->nama_supplier) {
            $validasiNamaSuppllier = 'required|unique:master_supplier_raw_materials';
        }
        if ($request->inisial_supplier != $MasterSPR->inisial_supplier) {
            $validasiInitialSuppllier = 'required|unique:master_supplier_raw_materials';
        }
        // validate form
        $validate = $this->validate($request, [
            'nama_supplier'             => $validasiNamaSuppllier,
            'inisial_supplier'          => $validasiInitialSuppllier,
            'status'                    => 'required'
        ]);

        $MasterSPR->update([
            'nama_supplier'     => $request->nama_supplier,
            'inisial_supplier'  => $request->inisial_supplier,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_supplier_raw_material.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterSPR = MasterSupplierRawMaterial::findOrFail($id);

        //delete
        $MasterSPR->delete();

        //redirect to index
        return redirect()->route('master_supplier_raw_material.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
