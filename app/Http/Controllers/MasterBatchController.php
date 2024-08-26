<?php

namespace App\Http\Controllers;

use App\Models\MasterBatch;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MasterBatchController extends Controller
{
    //index
    public function index()
    {
        $MasterBatch = MasterBatch::all();
        return response()->view('master.master_batch.index', [
            'master_batch' => $MasterBatch,
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nomor_batch'                   => 'required',
            'user_created'                  => 'required',
        ], [
            'nomor_batch.required'          => 'Kolom Nomor Batch Wajib diisi.',
            'user_created.required'         => 'Kolom NIP Admin Wajib diisi.',
        ]);
        //create MasterSupplier
        MasterBatch::create([
            'nomor_batch'                   => $request->nomor_batch,
            'user_created'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterBatch.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterBatch = MasterBatch::findOrFail($id);

        return view('master.master_batch.update', compact('MasterBatch'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterBatch = MasterBatch::findOrFail($id);

        //validate form
        $this->validate($request, [
            'nomor_batch'                   => 'required',
            'status'                        => 'required',
            'user_created'                  => 'required',
        ]);

        $MasterBatch->update([
            'nomor_batch'                   => $request->nomor_batch,
            'status'                        => $request->status,
            'user_updated'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterBatch.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // delete
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $MasterBatch = MasterBatch::findOrFail($id);

        //delete post
        $MasterBatch->delete();

        //redirect to index
        return redirect()->route('MasterBatch.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
