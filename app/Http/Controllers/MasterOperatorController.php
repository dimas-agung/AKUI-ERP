<?php

namespace App\Http\Controllers;

use App\Models\unit;
use App\Models\Perusahaan;
use App\Models\Workstation;
use Illuminate\Http\Request;
use App\Models\MasterOperator;
use Illuminate\Http\RedirectResponse;

class MasterOperatorController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterOperator = MasterOperator::with('Perusahaan')->get();
        // $perusahaan = Perusahaan::with('MasterOperator')->get();
        $perusahaan = Perusahaan::all();
        $workstation = Workstation::all();
        $unit = unit::all();
        // return $MasterOperator;
        // return $perusahaan;
        return response()->view('master.master_operator.index', [
            'master_operators' => $MasterOperator,
            'perusahaans' => $perusahaan,
            'workstations' => $workstation,
            'units' => $unit,
            'i' => $i
        ]);
    }
    //store
    public function store(Request $request)
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
            'grade_operator'    => 'required',
            'nama_team_leader'  => 'required',
            'job'               => 'required',

        ]);

        // Create MasterSupplier
        MasterOperator::create([
            'nama'              => $request->nama,
            'nip'               => $request->nip,
            'plant'             => $request->plant,
            'divisi'            => $request->divisi,
            'departemen'        => $request->departemen,
            'bagian'            => $request->bagian,
            'workstation'       => $request->workstation,
            'unit'              => $request->unit,
            'grade_operator'    => $request->grade_operator,
            'nama_team_leader'  => $request->nama_team_leader,
            'job'               => $request->job,
            'status',
        ]);

        // Redirect to index
        return redirect()->route('MasterOperator.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterOP = MasterOperator::findOrFail($id);
        $perusahaan = Perusahaan::with('MasterOperator')->get();
        $workstation = Workstation::with('MasterOperator')->get();
        $unit = unit::with('MasterOperator')->get();


        return view('master.master_operator.update', compact('MasterOP', 'perusahaan', 'workstation', 'unit'));
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
            'grade_operator'    => 'required',
            'nama_team_leader'  => 'required',
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
            'grade_operator'    => $request->grade_operator,
            'nama_team_leader'  => $request->nama_team_leader,
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
