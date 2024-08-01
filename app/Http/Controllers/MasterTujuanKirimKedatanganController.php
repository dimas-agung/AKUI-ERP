<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\MasterTujuanKirimKedatangan;

class MasterTujuanKirimKedatanganController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterTujuanKirimKedatangan = MasterTujuanKirimKedatangan::all();
        // return $MasterTujuanKirimKedatangan;
        return response()->view('master.master_tujuan_kirim_kedatangan.index', [
            'master_tujuan_kirim_kedatangan' => $MasterTujuanKirimKedatangan,
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
            'inisial_tujuan'            => 'required|unique:master_tujuan_kirim_kedatangans',
            'user_created'              => 'required',
        ], [
            'tujuan_kirim.required'     => 'Kolom Tujuan Kirim Wajib diisi.',
            'letak_tujuan.required'     => 'Kolom Letak Tujuan Wajib diisi.',
            'inisial_tujuan.required'   => 'Kolom Inisial Tujuan Wajib diisi.',
            'inisial_tujuan.unique'     => 'Inisial Tujuan sudah digunakan.',
        ]);

        //create MasterSupplier
        MasterTujuanKirimKedatangan::create([
            'tujuan_kirim'              => $request->tujuan_kirim,
            'letak_tujuan'              => $request->letak_tujuan,
            'inisial_tujuan'            => $request->inisial_tujuan,
            'user_created'              => $request->user_created,
        ]);
        //redirect to index
        return redirect()->route('MasterTujuanKirimKedatangan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterTujuanKirimKedatangan = MasterTujuanKirimKedatangan::findOrFail($id);

        return view('master.master_tujuan_kirim_kedatangan.update', compact('MasterTujuanKirimKedatangan'));
    }

    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterTujuanKirimKedatangan = MasterTujuanKirimKedatangan::findOrFail($id);
        $ValidasiInisialTujuan = 'required';
        if ($request->inisial_tujuan != $MasterTujuanKirimKedatangan->inisial_tujuan) {
            $ValidasiInisialTujuan = 'required|unique:master_tujuan_kirim_kedatangans';
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

        $MasterTujuanKirimKedatangan->update([
            'tujuan_kirim'      => $request->tujuan_kirim,
            'letak_tujuan'      => $request->letak_tujuan,
            'inisial_tujuan'    => $request->inisial_tujuan,
            'status'            => $request->status,
            'user_updated'      => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterTujuanKirimKedatangan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterTujuanKirimKedatangan = MasterTujuanKirimKedatangan::findOrFail($id);

        //delete
        $MasterTujuanKirimKedatangan->delete();

        //redirect to index
        return redirect()->route('MasterTujuanKirimKedatangan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
