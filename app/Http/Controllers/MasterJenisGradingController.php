<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisGrading;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MasterJenisGradingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $unit = Unit::with('MasterJenisGrading')->get();
        $MasterJenisGrading = MasterJenisGrading::all();
        // return $unit;
        // return $MasterJenisGrading;
        return response()->view('master.master_jenis_grading.index', [
            'master_jenis_gradings' => $MasterJenisGrading,
            'unit' => $unit,
            'i' => $i
        ]);
    }
    // create

    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'                  => 'required',
            'unit_id'               => 'required',
            'user_created'          => 'required',
        ]);
        //create MasterSupplier
        MasterJenisGrading::create([
            'nama'                  => $request->nama,
            'unit_id'               => $request->unit_id,
            'user_created'          => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('master_jenis_grading.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterJGD = MasterJenisGrading::findOrFail($id);
        $unit = unit::with('MasterJenisGrading')->get();

        return view('master.master_jenis_grading.update', compact('MasterJGD', 'unit'));
    }

    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterJGD = MasterJenisGrading::findOrFail($id);

        //validate form
        $this->validate($request, [
            'nama'                  => 'required',
            'unit_id'               => 'required',
            'user_created'          => 'required',
        ]);

        $MasterJGD->update([
            'nama'              => $request->nama,
            'unit_id'           => $request->unit_id,
            'status'            => $request->status,
            // 'user_created'      => $request->user_created,
            'user_updated'      => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('master_jenis_grading.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // delete
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $MasterJenisGrading = MasterJenisGrading::findOrFail($id);

        //delete post
        $MasterJenisGrading->delete();

        //redirect to index
        return redirect()->route('master_jenis_grading.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
