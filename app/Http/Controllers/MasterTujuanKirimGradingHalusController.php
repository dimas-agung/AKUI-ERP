<?php

namespace App\Http\Controllers;

use App\Models\MasterTujuanKirimGradingHalus;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterTujuanKirimGradingHalusController extends Controller
{
//index
public function index()
{
    $i = 1;
    $MasterTujuanKirimRawMaterial = MasterTujuanKirimGradingHalus::all();
    // return $MasterTujuanKirimRawMaterial;
    return response()->view('master.master_tujuan_kirim_grading_halus.index', [
        'MasterTujuanKirimRawMaterial' => $MasterTujuanKirimRawMaterial,
        'i' => $i
    ]);
}
// create
public function create()
{
    return view('master.master_tujuan_kirim_grading_halus.create');
}
// store
public function store(Request $request): RedirectResponse
{
    //validate form
    $this->validate($request, [
        'tujuan_kirim'              => 'required',
        'letak_tujuan'              => 'required',
        'inisial_tujuan'            => 'required|unique:master_tujuan_kirim_raw_materials'
    ], [
        'tujuan_kirim.required'     => 'Kolom Tujuan Kirim Wajib diisi.',
        'letak_tujuan.required'     => 'Kolom Letak Tujuan Wajib diisi.',
        'inisial_tujuan.required'   => 'Kolom Inisial Tujuan Wajib diisi.'
    ]);

    //create MasterSupplier
    MasterTujuanKirimGradingHalus::create([
        'tujuan_kirim'              => $request->tujuan_kirim,
        'letak_tujuan'              => $request->letak_tujuan,
        'inisial_tujuan'            => $request->inisial_tujuan
    ]);
    //redirect to index
    return redirect()->route('MasterTujuanKirimGradingHalus.index')->with(['success' => 'Data Berhasil Disimpan!']);
}
// show
public function show(string $id)
{
    //get by ID
    $MasterTJRM = MasterTujuanKirimGradingHalus::findOrFail($id);

    //render view
    return view('master.master_tujuan_kirim_grading_halus.show', compact('MasterTJRM'));
}
// edit
public function edit(string $id)
{
    $MasterTJRM = MasterTujuanKirimGradingHalus::findOrFail($id);

    return view('master.master_tujuan_kirim_grading_halus.update', compact('MasterTJRM'));
}

// update
public function update(Request $request, $id): RedirectResponse
{
    //get by ID
    $MasterTJRM = MasterTujuanKirimGradingHalus::findOrFail($id);
    $ValidasiInisialTujuan = 'required';
    if ($request->inisial_tujuan != $MasterTJRM->inisial_tujuan) {
        $ValidasiInisialTujuan = 'required|unique:master_tujuan_kirim_grading_haluses';
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

    $MasterTJRM->update([
        'tujuan_kirim'      => $request->tujuan_kirim,
        'letak_tujuan'      => $request->letak_tujuan,
        'inisial_tujuan'    => $request->inisial_tujuan,
        'status'            => $request->status
    ]);

    //redirect to index
    return redirect()->route('MasterTujuanKirimGradingHalus.index')->with(['success' => 'Data Berhasil Diubah!']);
}
// destroy
public function destroy($id): RedirectResponse
{
    //get by ID
    $MasterTJRM = MasterTujuanKirimGradingHalus::findOrFail($id);

    //delete
    $MasterTJRM->delete();

    //redirect to index
    return redirect()->route('MasterTujuanKirimGradingHalus.index')->with(['success' => 'Data Berhasil Dihapus!']);
}
}
