<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisGradingHalus;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MasterJenisGradingHalusController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterJenisGradingHalus = MasterJenisGradingHalus::all();
        return response()->view('master.master_jenis_grading_halus.index', [
            'master_jenis_grading_halus' => $MasterJenisGradingHalus,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'jenis'                          => 'required',
            'kategori_susut'                => 'nullable',
            'upah_operator'                 => 'nullable|numeric',
            'pengurangan_harga'  => 'nullable|numeric',
            'harga_estimasi'                => 'required|numeric',
            'user_created'                  => 'required',
        ], [
            'jenis.required'                 => 'Kolom Jenis Wajib diisi.',
            'harga_estimasi.numeric'        => 'Kolom Harga Estimasi Wajib diisi.',
            'user_created.required'         => 'Kolom NIP Admin Wajib diisi.',
        ]);
        //create MasterSupplier
        MasterJenisGradingHalus::create([
            'jenis'                          => $request->jenis,
            'kategori_susut'                => $request->kategori_susut,
            'upah_operator'                 => $request->upah_operator,
            'pengurangan_harga'  => $request->pengurangan_harga,
            'harga_estimasi'                => $request->harga_estimasi,
            'user_created'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterJenisGradingHalus.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterJGK = MasterJenisGradingHalus::findOrFail($id);

        return view('master.master_jenis_grading_halus.update', compact('MasterJGK'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterJGK = MasterJenisGradingHalus::findOrFail($id);

        //validate form
        $this->validate($request, [
            'jenis'                          => 'required',
            'kategori_susut'                => 'required',
            'upah_operator'                 => 'required',
            'pengurangan_harga'             => 'required',
            'status'             => 'required',
            'harga_estimasi'                => 'required',
            'user_created'                  => 'required',
        ]);

        $MasterJGK->update([
            'jenis'                          => $request->jenis,
            'kategori_susut'                => $request->kategori_susut,
            'upah_operator'                 => $request->upah_operator,
            'status'                        => $request->status,
            'pengurangan_harga'             => $request->pengurangan_harga,
            'harga_estimasi'                => $request->harga_estimasi,
            'user_updated'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterJenisGradingHalus.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // delete
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $MasterJenisGradingHalus = MasterJenisGradingHalus::findOrFail($id);

        //delete post
        $MasterJenisGradingHalus->delete();

        //redirect to index
        return redirect()->route('MasterJenisGradingHalus.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
