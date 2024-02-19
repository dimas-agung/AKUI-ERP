<?php

namespace App\Http\Controllers;

use App\Models\MasterOperator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MasterOperatorController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterOperator = MasterOperator::all();
        // return $MasterOperator;
        return response()->view('master.master_operator.index', [
            'master_operators' => $MasterOperator,
            'i' => $i
        ]);
    }
    //store
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $this->validate($request, [
            'nama'              => 'required',
            'nip'               => 'required',
            'plant'             => 'required',
            'divisi'            => 'required',
            'departemen'        => 'required',
            'bagian'            => 'required',
            'workstation'       => 'required',
            'unit'              => 'required',
            'job'               => 'required',

        ]);

        // Create MasterSupplier
        MasterOperator::create([
            'nama'              => $request->nama,
            'nip'               => $request->nip,
            'plant'             => $request->plant,
            'divisi'            => $request->divisi,
            'departemen'        => $request->departemen,
            'bagian'            => $request->departemen,
            'workstation'       => $request->departemen,
            'unit'              => $request->unit,
            'job'               => $request->job,
        ]);

        // Redirect to index
        return redirect()->route('MasterOperator.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterOP = MasterOperator::findOrFail($id);

        return view('master.master_operator.update', compact('MasterOP'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterOP = MasterOperator::findOrFail($id);

        //validate form
        $this->validate($request, [
            'nama'              => 'required',
            'nip'               => 'required',
            'plant'             => 'required',
            'divisi'            => 'required',
            'departemen'        => 'required',
            'bagian'            => 'required',
            'workstation'       => 'required',
            'unit'              => 'required',
            'job'               => 'required',
        ]);

        $MasterOP->update([
            'nama'              => $request->nama,
            'nip'               => $request->nip,
            'plant'             => $request->plant,
            'divisi'            => $request->divisi,
            'departemen'        => $request->departemen,
            'bagian'            => $request->bagian,
            'workstation'       => $request->workstation,
            'unit'              => $request->unit,
            'job'               => $request->job,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('MasterOperator.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterOP = MasterOperator::findOrFail($id);

        //delete
        $MasterOP->delete();

        //redirect to index
        return redirect()->route('MasterOperator.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
