<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisRawMaterial;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterJenisRawMaterialController extends Controller
{
    //index
    public function index()
    {
        $MasterJenisRawMaterial = MasterJenisRawMaterial::all();

        return response()->view('master.master_jenis_raw_material.index', [
            'MasterJenisRawMaterial' => $MasterJenisRawMaterial,
        ]);
    }
    // create
    public function create()
    {
        return view('master.master_jenis_raw_material.create');
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'jenis'                 => 'required|unique:master_jenis_raw_materials',
            'kategori_susut',
            'upah_operator',
            'pengurangan_harga',
            'harga_estimasi',
        ], [
            'jenis.required' => 'Kolom Jenis Wajib diisi.',
        ]);

        //create MasterSupplier
        MasterJenisRawMaterial::create([
            'jenis'                 => $request->jenis,
            'kategori_susut'        => $request->kategori_susut,
            'upah_operator'         => $request->upah_operator,
            'pengurangan_harga'     => $request->pengurangan_harga,
            'harga_estimasi'        => $request->harga_estimasi,
        ]);

        //redirect to index
        return redirect()->route('master_jenis_raw_material.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // show
    public function show(string $id)
    {
        //get by ID
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        //render view
        return view('master.master_jenis_raw_material.show', compact('MasterJRM'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        return view('master.master_jenis_raw_material.update', compact('MasterJRM'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        //validate form
        $validate = $this->validate($request, [
            'jenis'                 => 'required',
            'kategori_susut',
            'upah_operator'         => 'numeric',
            'pengurangan_harga'     => 'numeric',
            'harga_estimasi'        => 'numeric'
        ]);

        $MasterJRM->update([
            'jenis'                 => $request->jenis,
            'kategori_susut'        => $request->kategori_susut,
            'upah_operator'         => $request->upah_operator,
            'pengurangan_harga'     => $request->pengurangan_harga,
            'harga_estimasi'        => $request->harga_estimasi,
            'status'                => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_jenis_raw_material.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        //delete
        $MasterJRM->delete();

        //redirect to index
        return redirect()->route('master_jenis_raw_material.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
