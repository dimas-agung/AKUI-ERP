<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Http\Controllers\Controller;
use App\Models\MasterJenisRawMaterial;
use Illuminate\Http\Request;
use App\Models\MasterSupplierRawMaterial;
use Illuminate\Http\RedirectResponse;

class PrmRawMaterialInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->get();
        $PrmRawMaterialInput = PrmRawMaterialInput::with('MasterSupplierRawMaterial')->get();
        // return $PrmRawMaterialInput;
        // return $MasterSupplierRawMaterial;
        // return $MasterJenisRawMaterial;
        return response()->view('purchasing_exim.prm_raw_material_input.index', [
            'prm_raw_material_inputs'       => $PrmRawMaterialInput,
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
            'prm_raw_material_input_items'  => $PrmRawMaterialInputItem,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        return view('purchasing_exim/prm_raw_material_input.create', [
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
        ]);
    }
    // get Data Supplier
    public function getDataSupplier(Request $request)
    {
        $nama_supplier = $request->nama_supplier;
        // Lakukan logika untuk mengatur nomor batch berdasarkan id_box
        // $nomorBatch = $this->query('nomor_batch',$id_box);
        $data = MasterSupplierRawMaterial::where('nama_supplier', $nama_supplier)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    // get Data Jenis
    public function getDataJenis(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisRawMaterial::where('jenis', $jenis)->first();

        return response()->json($data);
    }

    public function simpanData(Request $request)
    {
        $dataArray = json_decode($request->input('data'));
        $dataHeader = json_decode($request->input('dataHeader'));
        // return $dataArray;
        // var_dump($dataArray[0]);
        // return;
        // return $dataHeader[0];
        // Pastikan doc_no ada dan merupakan string sebelum menggunakan substr

        // Lakukan sesuatu dengan data, misalnya menyimpan ke database
        PrmRawMaterialInput::create([
            // 'doc_no'                => $dataHeader[0]->doc_no,
            'nomor_po'              => $dataHeader[0]->nomor_po,
            'nomor_batch'           => $dataHeader[0]->nomor_batch,
            'nomor_nota_supplier'   => $dataHeader[0]->nomor_nota_supplier,
            'nomor_nota_internal'   => $dataHeader[0]->nomor_nota_internal,
            'nama_supplier'         => $dataHeader[0]->nama_supplier,
            'keterangan'            => $dataHeader[0]->keterangan,
            'user_created'          => $dataHeader[0]->user_created,
            // 'user_updated'          => $dataHeader[0]->user_updated
        ]);
        foreach ($dataArray as $item) {
            // Simpan data ke dalam database menggunakan Eloquent atau Query Builder
            PrmRawMaterialInputItem::create([
                // 'doc_no'            => $item->doc_no,
                'jenis'             => $item->jenis,
                'berat_nota'        => $item->berat_nota,
                'berat_kotor'       => $item->berat_kotor,
                'berat_bersih'      => $item->berat_bersih,
                'selisih_berat'     => $item->selisih_berat,
                'kadar_air'         => $item->kadar_air,
                'id_box'            => $item->id_box,
                'harga_nota'        => $item->harga_nota,
                'total_harga_nota'  => $item->total_harga_nota,
                'harga_deal'        => $item->harga_deal,
                'keterangan'        => $item->keterangan,
                'user_created'      => $item->user_created,
                // 'user_updated'      => $item->user_updated
                // Sesuaikan dengan kolom-kolom lain di tabel Anda
            ]);
        }
        return response()->json(['message' => 'Data Berhasil Disimpan']);
        // return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'doc_no.*',
            'nomor_po'               => 'required',
            'nomor_batch'            => 'required',
            'nomor_nota_supplier'    => 'required',
            'nomor_nota_internal'    => 'required',
            'nama_supplier'          => 'required',
            'jenis'                  => 'required',
            'berat_nota'             => 'required',
            'berat_kotor'            => 'required',
            'berat_bersih'           => 'required',
            'selisih_berat'          => 'required',
            'kadar_air'              => 'required',
            'id_box'                 => 'required',
            'harga_nota'             => 'required',
            'total_harga_nota'       => 'required',
            'harga_deal'             => 'required',
            'keterangan',
            'user_created',
            'user_updated',
        ]);

        //create Purchasing Raw Material Input
        PrmRawMaterialInput::create([
            'doc_no'                => $request->doc_no,
            'nomor_po'              => $request->nomor_po,
            'nomor_batch'           => $request->nomor_batch,
            'nomor_nota_supplier'   => $request->nomor_nota_supplier,
            'nomor_nota_internal'   => $request->nomor_nota_internal,
            'nama_supplier'         => $request->nama_supplier,
            'keterangan'            => $request->keterangan,
            'user_created'          => $request->user_created,
            'user_updated'          => $request->user_updated
        ]);
        //create Purchasing Raw Material Item
        PrmRawMaterialInputItem::create([
            'doc_no'                => $request->doc_no,
            'jenis'                 => $request->jenis,
            'berat_nota'            => $request->berat_nota,
            'berat_kotor'           => $request->berat_kotor,
            'berat_bersih'          => $request->berat_bersih,
            'selisih_berat'         => $request->selisih_berat,
            'kadar_air'             => $request->kadar_air,
            'id_box'                => $request->id_box,
            'harga_nota'            => $request->harga_nota,
            'total_harga_nota'      => $request->total_harga_nota,
            'harga_deal'            => $request->harga_deal,
            'keterangan'            => $request->keterangan,
            'user_created'          => $request->user_created,
            'user_updated'          => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('prm_raw_material_input.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    // show
    public function show(string $id)
    {
        //get by ID
        $MasterPRIM = PrmRawMaterialInput::findOrFail($id);
        $MasterPRIM = PrmRawMaterialInput::with('PrmRawMaterialInputItem')
            ->where(['id' => $id])
            ->first();

        //render view
        return view('purchasing_exim.prm_raw_material_input.show', compact('MasterPRIM'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterPRIM = PrmRawMaterialInput::findOrFail($id);

        return view('purchasing_exim.prm_raw_material_input.update', compact('MasterPRIM'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterSPR = MasterSupplierRawMaterial::findOrFail($id);
        $ValidasiNamaSupplier = 'required';
        $ValidasiInisialSupplier = 'required';
        if ($request->nama_supplier != $MasterSPR->nama_supplier) {
            $ValidasiNamaSupplier = 'required|unique:master_supplier_raw_materials';
        }
        if ($request->inisial_supplier != $MasterSPR->inisial_supplier) {
            $ValidasiInisialSupplier = 'required|unique:master_supplier_raw_materials';
        }
        // validate form
        $this->validate($request, [
            'nama_supplier'      => $ValidasiNamaSupplier,
            'inisial_supplier'   => $ValidasiInisialSupplier,
            'status'             => 'required',
        ], [
            'nama_supplier'     => 'Nama Supplier Sudah Digunakan',
            'inisial_supplier'  => 'Inisial Supplier Sudah Digunakan',

        ]);
        $MasterSPR->update([
            'nama_supplier'     => $request->nama_supplier,
            'inisial_supplier'  => $request->inisial_supplier,
            'status'            => $request->status,
        ]);

        //redirect to index
        return redirect()->route('master_supplier_raw_material.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterSPR = MasterSupplierRawMaterial::findOrFail($id);

        //delete
        $MasterSPR->delete();

        //redirect to index
        return redirect()->route('master_supplier_raw_material.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
