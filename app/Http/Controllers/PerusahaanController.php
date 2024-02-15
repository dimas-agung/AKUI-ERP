<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PerusahaanController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $Perusahaan = Perusahaan::all();
        // return $MasterSupplier;
        return response()->view('perusahaan.index', [
            'Perusahaan' => $Perusahaan,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'              => 'required',
            'plant'             => 'required'
        ]);

        //create MasterSupplier
        Perusahaan::create([
            'nama'             => $request->nama,
            'plant'          => $request->plant
        ]);

        //redirect to index
        return redirect()->route('Perusahaan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // show
    public function show(string $id)
    {
        //get by ID
        $Perusahaan = Perusahaan::findOrFail($id);

        //render view
        return view('perusahaan.show', compact('Perusahaan'));
    }
    // edit
    public function edit(string $id)
    {
        $Perusahaan = Perusahaan::findOrFail($id);

        return view('perusahaan.update', compact('Perusahaan'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $Perusahaan = Perusahaan::findOrFail($id);
        // $ValidasiNamaSupplier = 'required';
        $ValidasiPlant = 'required';
        // if ($request->nama_supplier != $Perusahaan->nama_supplier) {
        //     $ValidasiNamaSupplier = 'required|unique:master_supplier_raw_materials';
        // }
        if ($request->plant != $Perusahaan->plant) {
            $ValidasiPlant = 'required|unique:perusahaan';
        }
        // validate form
        $this->validate($request, [
            // 'nama_supplier'      => $ValidasiNamaSupplier,
            'nama'      => 'required',
            'plant'   => $ValidasiPlant,
            'status'             => 'required',
        ], [
            'plant'  => 'Plant Sudah Digunakan',

        ]);
        $Perusahaan->update([
            'nama'     => $request->nama,
            'plant'  => $request->plant,
            'status'            => $request->status,
        ]);

        //redirect to index
        return redirect()->route('Perusahaan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $Perusahaan = Perusahaan::findOrFail($id);

        //delete
        $Perusahaan->delete();

        //redirect to index
        return redirect()->route('Perusahaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
