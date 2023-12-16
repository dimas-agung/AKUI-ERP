<?php

namespace App\Http\Controllers\PurchasingExim;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialOutputHeader;
use App\Models\PrmRawMaterialOutputItem;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class PrmRawMaterialOutputController extends Controller
{
    public function index(){
        $i =1;
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('PrmRawMaterialOutputItem')->get();
        $PrmRawMOIC = PrmRawMaterialOutputItem::with('PrmRawMaterialOutputHeader')->get();
        return response()->view('purchasing_exim.PrmRawMaterialOutput.index', [
            'PrmRawMOIC' => $PrmRawMOIC,
            'PrmRawMOH' => $PrmRawMOH,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        return view('purchasing_exim.PrmRawMaterialOutput.create');
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'doc_no'       => 'required',
            'nomor_bstb'   => 'required|unique',
            'nomor_batch'  => 'required',
            'id_box'       => 'required',
            'nama_supplier'=> 'required',
            'jenis'        => 'required',
            'berat'        => 'required',
            'kadar_air'    => 'required',
            'tujuan_kirim' => 'required',
            'letak_tujuan' => 'required',
            'inisial_tujuan'=> 'required',
            'modal'        => 'required',
            'total_modal'  => 'required',
            'keterangan'   => 'required',
            'user_created' => '',
            'user_updated' => ''
        ], [
            'doc_no.required' => 'Kolom Nomer Document Wajib diisi.',
            'nomor_bstb.required' => 'Kolom Nomer BSTB Wajib diisi.'
        ]);

        //create post
        PrmRawMaterialOutputItem::create([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'id_box'        => $request->id_box,
            'nama_supplier' => $request->nama_supplier,
            'jenis'         => $request->jenis,
            'berat'         => $request->berat,
            'kadar_air'     => $request->kadar_air,
            'tujuan_kirim'  => $request->tujuan_kirim,
            'letak_tujuan'  => $request->letak_tujuan,
            'inisial_tujuan'=> $request->inisial_tujuan,
            'modal'         => $request->modal,
            'total_modal'   => $request->total_modal,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated
        ]);

        PrmRawMaterialOutputHeader::create([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // Show
    public function show(string $id): View
    {
        //get post by ID
        $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('PrmRawMaterialOutputItem')->get();

        //render view with post
        return view('purchasing_exim.PrmRawMaterialOutput.show', compact('PrmRawMOIC', 'PrmRawMOH'));
    }


         /**
     * edit
     */
    public function edit(string $id): View
    {
        //get post by ID
        $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('PrmRawMaterialOutputItem')->get();

        //render view with post
        return view('purchasing_exim.PrmRawMaterialOutput.update', compact('PrmRawMOIC', 'PrmRawMOH'));
    }

    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('PrmRawMaterialOutputItem')->get();
        //validate form
        $this->validate($request, [
            'doc_no'       => 'required',
            'nomor_bstb'   => 'required',
            'nomor_batch'  => 'required',
            'id_box'       => 'required',
            'nama_supplier'=> 'required',
            'jenis'        => 'required',
            'berat'        => 'required',
            'kadar_air'    => 'required',
            'tujuan_kirim' => 'required',
            'letak_tujuan' => 'required',
            'inisial_tujuan'=> 'required',
            'modal'        => 'required',
            'total_modal'  => 'required',
            'keterangan'   => '',
            'user_created' => '',
            'user_updated' => ''
        ], [
            'doc_no.required' => 'Kolom Nomer Document Wajib diisi.',
            'nomor_bstb.required' => 'Kolom Nomer BSTB Wajib diisi.'
        ]);

        //get post by ID

        $PrmRawMOIC->update([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'id_box'        => $request->id_box,
            'nama_supplier' => $request->nama_supplier,
            'jenis'         => $request->jenis,
            'berat'         => $request->berat,
            'kadar_air'     => $request->kadar_air,
            'tujuan_kirim'  => $request->tujuan_kirim,
            'letak_tujuan'  => $request->letak_tujuan,
            'inisial_tujuan'=> $request->inisial_tujuan,
            'modal'         => $request->modal,
            'total_modal'   => $request->total_modal,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated
        ]);

        $PrmRawMOH->update([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


        /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('PrmRawMaterialOutputItem')->get();

        //delete post
        $PrmRawMOIC->delete();
        $PrmRawMOH->delete();

        //redirect to index
        return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
