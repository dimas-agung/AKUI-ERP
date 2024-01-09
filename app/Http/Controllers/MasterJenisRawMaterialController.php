<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PurchasingExim\PrmRawMaterialInput as PurchasingEximPrmRawMaterialInput;
use App\Models\MasterJenisRawMaterial;
use App\Models\PrmRawMaterialInputItem;
use App\Helpers\RupiahFormatterHelper;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterJenisRawMaterialController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('MasterJenisRawMaterial')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::all();
        // return $PrmRawMaterialInput;
        // return $MasterJenisRawMaterial;
        return response()->view('master.master_jenis_raw_material.index', [
            'PrmRawMaterialInput'    => $PrmRawMaterialInputItem,
            'MasterJenisRawMaterial' => $MasterJenisRawMaterial,
            'i' => $i
        ]);
    }
    // create
    // public function create()
    // {
    //     return view('master.master_jenis_raw_material.create');
    // }
    // store
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $this->validate($request, [
            'jenis'             => 'required|unique:master_jenis_raw_materials',
            'kategori_susut'    => 'required',
            'upah_operator'     => 'nullable|numeric', // Tambahkan validasi untuk numeric
            'pengurangan_harga' => 'nullable|numeric', // Tambahkan validasi untuk numeric
            'harga_estimasi'    => 'nullable|numeric', // Tambahkan validasi untuk numeric
        ], [
            'jenis.required'            => 'Kolom Jenis Wajib diisi.',
            'kategori_susut.required'   => 'Kolom Kategori Susut Wajib diisi.',
            'upah_operator.numeric'     => 'Kolom Upah Operator harus berupa angka.',
            'pengurangan_harga.numeric' => 'Kolom Pengurangan Harga harus berupa angka.',
            'harga_estimasi.numeric'    => 'Kolom Harga Estimasi harus berupa angka.',
        ]);

        // // Format nilai rupiah sebelum disimpan
        // $upahOperator = $request->has('upah_operator') ? RupiahFormatterHelper::format($request->upah_operator) : null;
        // $hargaEstimasi = $request->has('harga_estimasi') ? RupiahFormatterHelper::format($request->harga_estimasi) : null;

        // Create MasterSupplier
        MasterJenisRawMaterial::create([
            'jenis'                 => $request->jenis,
            'kategori_susut'        => $request->kategori_susut,
            'upah_operator'         => $request->upah_operator,
            'pengurangan_harga'     => $request->pengurangan_harga,
            'harga_estimasi'        => $request->harga_estimasi,
        ]);

        // Redirect to index
        return redirect()->route('master_jenis_raw_material.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // show
    public function show(string $id)
    {
        //get by ID
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        //render view
        return view('master.master_jenis_raw_material.show', compact('MasterJRM'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        return view('master.master_jenis_raw_material.update', compact('MasterJRM'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);
        $ValidasiJenis = 'required';
        if ($request->jenis != $MasterJRM->jenis) {
            $ValidasiJenis = 'required|unique:master_jenis_raw_materials';
        }

        //validate form
        $validate = $this->validate($request, [
            'jenis'                 => $ValidasiJenis,
            'kategori_susut'        => 'required',
            'upah_operator',
            'pengurangan_harga',
            'harga_estimasi'
        ], [
            'jenis' => 'Jenis Sudah Digunakan'
        ]);

        $MasterJRM->update([
            'jenis'                 => $request->jenis,
            'kategori_susut'        => $request->kategori_susut,
            'upah_operator'         => $request->upah_operator,
            'pengurangan_harga'     => $request->pengurangan_harga,
            'harga_estimasi'        => $request->harga_estimasi,
            'status'                => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_jenis_raw_material.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterJRM = MasterJenisRawMaterial::findOrFail($id);

        //delete
        $MasterJRM->delete();

        //redirect to index
        return redirect()->route('master_jenis_raw_material.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
