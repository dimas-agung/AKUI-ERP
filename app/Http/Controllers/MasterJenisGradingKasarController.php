<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisGradingKasar;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MasterJenisGradingKasarController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterJenisGradingKasar = MasterJenisGradingKasar::all();
        return response()->view('master.master_jenis_grading_kasar.index', [
            'master_jenis_grading_kasars' => $MasterJenisGradingKasar,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'                          => 'required',
            'kategori_susut'                => 'nullable|numeric',
            'upah_operator'                 => 'nullable|numeric',
            'presentase_pengurangan_harga'  => 'nullable|numeric',
            'harga_estimasi'                => 'required|numeric',
            'user_created'                  => 'required',
        ], [
            'nama.required'                 => 'Kolom Jenis Wajib diisi.',
            'harga_estimasi.numeric'        => 'Kolom Harga Estimasi Wajib diisi.',
            'user_created.required'         => 'Kolom NIP Admin Wajib diisi.',
        ]);
        //create MasterSupplier
        MasterJenisGradingKasar::create([
            'nama'                          => $request->nama,
            'kategori_susut'                => $request->kategori_susut,
            'upah_operator'                 => $request->upah_operator,
            'presentase_pengurangan_harga'  => $request->presentase_pengurangan_harga,
            'harga_estimasi'                => $request->harga_estimasi,
            'user_created'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('master_jenis_grading_kasar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterJGK = MasterJenisGradingKasar::findOrFail($id);

        return view('master.master_jenis_grading_kasar.update', compact('MasterJGK'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterJGK = MasterJenisGradingKasar::findOrFail($id);

        //validate form
        $this->validate($request, [
            'nama'                          => 'required',
            'kategori_susut'                => 'required',
            'upah_operator'                 => 'required',
            'presentase_pengurangan_harga'  => 'required',
            'harga_estimasi'                => 'required',
            'user_created'                  => 'required',
        ]);

        $MasterJGK->update([
            'nama'                          => $request->nama,
            'kategori_susut'                => $request->kategori_susut,
            'upah_operator'                 => $request->upah_operator,
            'presentase_pengurangan_harga'  => $request->presentase_pengurangan_harga,
            'harga_estimasi'                => $request->harga_estimasi,
            'user_updated'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('master_jenis_grading_kasar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // delete
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $MasterJenisGradingKasar = MasterJenisGradingKasar::findOrFail($id);

        //delete post
        $MasterJenisGradingKasar->delete();

        //redirect to index
        return redirect()->route('master_jenis_grading_kasar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
