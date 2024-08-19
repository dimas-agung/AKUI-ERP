<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterJenisKedatangan;
use Illuminate\Http\RedirectResponse;

class MasterJenisKedatanganController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterJenisKedatangan = MasterJenisKedatangan::all();
        return response()->view('master.master_jenis_kedatangan.index', [
            'master_jenis_kedatangan' => $MasterJenisKedatangan,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'jenis'                         => 'required|unique:master_jenis_kedatangans',
            'kategori_susut'                => 'nullable',
            'upah_operator'                 => 'nullable|numeric',
            'pengurangan_harga'             => 'nullable|numeric',
            'harga_estimasi'                => 'required|numeric',
            'user_created'                  => 'required',
        ], [
            'jenis.required'                => 'Kolom Jenis Wajib diisi.',
            'jenis.unique'                  => 'Nama Jenis Sudah Digunakan.',
            'harga_estimasi.numeric'        => 'Kolom Harga Estimasi Wajib diisi.',
        ]);
        //create MasterSupplier
        MasterJenisKedatangan::create([
            'jenis'                         => $request->jenis,
            'kategori_susut'                => $request->kategori_susut,
            'upah_operator'                 => $request->upah_operator,
            'pengurangan_harga'             => $request->pengurangan_harga,
            'harga_estimasi'                => $request->harga_estimasi,
            'user_created'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterJenisKedatangan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // edit
    public function edit(string $id)
    {
        $MasterJenisKedatangan = MasterJenisKedatangan::findOrFail($id);

        return view('master.master_jenis_kedatangan.update', compact('MasterJenisKedatangan'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterJenisKedatangan = MasterJenisKedatangan::findOrFail($id);
        $ValidasiNamaJenis = 'required';
        if ($request->jenis != $MasterJenisKedatangan->jenis) {
            $ValidasiNamaJenis = 'required|unique:master_jenis_kedatangans';
        }

        //validate form
        $this->validate($request, [
            'jenis'                         => $ValidasiNamaJenis,
            // 'kategori_susut'                => 'required',
            // 'upah_operator'                 => 'required',
            // 'pengurangan_harga'             => 'required',
            'status'                        => 'required',
            'harga_estimasi'                => 'required',
            'user_created'                  => 'required',
        ], [
            'jenis'                         => 'Nama Jenis Sudah Digunakan'
        ]);

        $MasterJenisKedatangan->update([
            'jenis'                         => $request->jenis,
            'kategori_susut'                => $request->kategori_susut,
            'upah_operator'                 => $request->upah_operator,
            'status'                        => $request->status,
            'pengurangan_harga'             => $request->pengurangan_harga,
            'harga_estimasi'                => $request->harga_estimasi,
            'user_updated'                  => $request->user_created,
        ]);

        //redirect to index
        return redirect()->route('MasterJenisKedatangan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // delete
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $MasterJenisKedatangan = MasterJenisKedatangan::findOrFail($id);

        //delete post
        $MasterJenisKedatangan->delete();

        //redirect to index
        return redirect()->route('MasterJenisKedatangan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
