<?php

namespace App\Http\Controllers;

use App\Models\MasterTujuanKirimGradingKasar;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterTujuanKirimGradingKasarController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterTujuanKirimGradingKasar = MasterTujuanKirimGradingKasar::all();
        // return $MasterTujuanKirimGradingKasar;
        return response()->view('master.master_tujuan_kirim_grading_kasar.index', [
            'master_tujuan_kirim_grading_kasar' => $MasterTujuanKirimGradingKasar,
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
            'inisial_tujuan'            => 'required|unique:master_tujuan_kirim_grading_kasars'
        ], [
            'tujuan_kirim.required'     => 'Kolom Tujuan Kirim Wajib diisi.',
            'letak_tujuan.required'     => 'Kolom Letak Tujuan Wajib diisi.',
            'inisial_tujuan.required'   => 'Kolom Inisial Tujuan Wajib diisi.'
        ]);

        //create MasterSupplier
        MasterTujuanKirimGradingKasar::create([
            'tujuan_kirim'              => $request->tujuan_kirim,
            'letak_tujuan'              => $request->letak_tujuan,
            'inisial_tujuan'            => $request->inisial_tujuan
        ]);
        //redirect to index
        return redirect()->route('master_tujuan_kirim_grading_kasar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // show
    public function show(string $id)
    {
        //get by ID
        $MasterTJGK = MasterTujuanKirimGradingKasar::findOrFail($id);

        //render view
        return view('master.master_tujuan_kirim_grading_kasar.show', compact('MasterTJGK'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterTJGK = MasterTujuanKirimGradingKasar::findOrFail($id);

        return view('master.master_tujuan_kirim_grading_kasar.update', compact('MasterTJGK'));
    }

    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterTJGK = MasterTujuanKirimGradingKasar::findOrFail($id);
        $ValidasiInisialTujuan = 'required';
        if ($request->inisial_tujuan != $MasterTJGK->inisial_tujuan) {
            $ValidasiInisialTujuan = 'required|unique:master_tujuan_kirim_grading_kasars';
        }
        //validate form
        $validate = $this->validate($request, [
            'tujuan_kirim'      => 'required',
            'letak_tujuan'      => 'required',
            'inisial_tujuan'    => $ValidasiInisialTujuan,
            'status'            => 'required'
        ], [
            'inisial_tujuan'    => 'Inisial Tujuan Sudah Digunakan'
        ]);

        $MasterTJGK->update([
            'tujuan_kirim'      => $request->tujuan_kirim,
            'letak_tujuan'      => $request->letak_tujuan,
            'inisial_tujuan'    => $request->inisial_tujuan,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_tujuan_kirim_grading_kasar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterTJGK = MasterTujuanKirimGradingKasar::findOrFail($id);

        //delete
        $MasterTJGK->delete();

        //redirect to index
        return redirect()->route('master_tujuan_kirim_grading_kasar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
