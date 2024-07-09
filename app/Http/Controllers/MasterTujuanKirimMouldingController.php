<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\MasterTujuanKirimMoulding;

class MasterTujuanKirimMouldingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterTujuanKirimMoulding = MasterTujuanKirimMoulding::all();
        // return $MasterTujuanKirimMoulding;
        return response()->view('master.master_tujuan_kirim_moulding.index', [
            'master_tujuan_kirim_moulding' => $MasterTujuanKirimMoulding,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'tujuan_kirim'              => 'required',
            'letak_tujuan'              => 'required',
            'inisial_tujuan'            => 'required|unique:master_tujuan_kirim_mouldings',
            'user_created'              => 'required',
        ], [
            'tujuan_kirim.required'     => 'Kolom Tujuan Kirim Wajib diisi.',
            'letak_tujuan.required'     => 'Kolom Letak Tujuan Wajib diisi.',
            'inisial_tujuan.required'   => 'Kolom Inisial Tujuan Wajib diisi.',
            'inisial_tujuan.unique'     => 'Inisial Tujuan sudah digunakan.',
        ]);

        //create MasterSupplier
        MasterTujuanKirimMoulding::create([
            'tujuan_kirim'              => $request->tujuan_kirim,
            'letak_tujuan'              => $request->letak_tujuan,
            'inisial_tujuan'            => $request->inisial_tujuan,
            'user_created'              => $request->user_created,
        ]);
        //redirect to index
        return redirect()->route('MasterTujuanKirimMoulding.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterTujuanKirimMoulding = MasterTujuanKirimMoulding::findOrFail($id);

        return view('master.master_tujuan_kirim_moulding.update', compact('MasterTujuanKirimMoulding'));
    }

    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterTujuanKirimMoulding = MasterTujuanKirimMoulding::findOrFail($id);
        $ValidasiInisialTujuan = 'required';
        if ($request->inisial_tujuan != $MasterTujuanKirimMoulding->inisial_tujuan) {
            $ValidasiInisialTujuan = 'required|unique:master_tujuan_kirim_mouldings';
        }
        //validate form
        $validate = $this->validate($request, [
            'tujuan_kirim'      => 'required',
            'letak_tujuan'      => 'required',
            'inisial_tujuan'    => $ValidasiInisialTujuan,
            'status'            => 'required',
            'user_created'      => 'required',
        ], [
            'inisial_tujuan'    => 'Inisial Tujuan Sudah Digunakan'
        ]);

        $MasterTujuanKirimMoulding->update([
            'tujuan_kirim'      => $request->tujuan_kirim,
            'letak_tujuan'      => $request->letak_tujuan,
            'inisial_tujuan'    => $request->inisial_tujuan,
            'status'            => $request->status,
            'user_updated'      => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterTujuanKirimMoulding.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterTujuanKirimMoulding = MasterTujuanKirimMoulding::findOrFail($id);

        //delete
        $MasterTujuanKirimMoulding->delete();

        //redirect to index
        return redirect()->route('MasterTujuanKirimMoulding.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
