<?php

namespace App\Http\Controllers\PurchasingExim;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialOutputHeader;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;
class PrmRawMaterialOutputHeaderController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $stockTGK = StockTransitGradingKasar::with('PramRawMaterialOutputHeaders')->get();
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('StockTransitGradingKasar')->get();
        return response()->view('purchasing_exim.PrmRawMaterialOutputHeader.index', [
            'PrmRawMOH' => $PrmRawMOH,
            'stockTGK' => $stockTGK,
            'i' => $i,
        ]);
    }


        /**
     * Create
     */
    public function create(): View
    {
        return view('purchasing_exim.PrmRawMaterialOutputHeader.show');
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'doc_no'        => 'required',
            'nomor_bstb'    => 'required|unique:prm_raw_material_output_headers',
            'nomor_batch'   => '',
            'keterangan'    => '',
            'user_created'  => '',
            'user_updated'  => ''
        ], [
            'doc_no.required'       => 'Kolom Nomer Document Wajib diisi.',
            'nomor_bstb.required'   => 'Kolom Nomer BSTB Wajib diisi.'
        ]);

        //create post
        PrmRawMaterialOutputHeader::create([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('PrmRawMaterialOutputHeader.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show(string $id): View
    {
        //get post by ID
        $PrmRawMOH = PrmRawMaterialOutputHeader::findOrFail($id);

        //render view with post
        return view('purchasing_exim.PrmRawMaterialOutputHeader.show', compact('PrmRawMOH'));
    }


     /**
     * edit
     */
    public function edit(string $id): View
    {
        //get post by ID
        $PrmRawMOH = PrmRawMaterialOutputHeader::findOrFail($id);

        //render view with post
        return view('purchasing_exim.PrmRawMaterialOutputHeader.update', compact('PrmRawMOH'));
    }

    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $PrmRawMOH = PrmRawMaterialOutputHeader::findOrFail($id);
        //validate form
        $this->validate($request, [
            'doc_no'        => 'required',
            'nomor_bstb'    => 'required',
            'nomor_batch'   => 'required',
            'keterangan'    => 'required',
            'user_created'  => 'required',
            'user_updated'  => 'required'
        ], [
            'doc_no.required'       => 'Kolom Nomer Document Wajib diisi.',
            'nomor_bstb.required'   => 'Kolom Nomer BSTB Wajib diisi.'
        ]);

        //get post by ID

        $PrmRawMOH->update([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'keterangan'    => $request->keterangan,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('PrmRawMaterialOutputHeader.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


        /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $PrmRawMOH = PrmRawMaterialOutputHeader::findOrFail($id);

        //delete post
        $PrmRawMOH->delete();

        //redirect to index
        return redirect()->route('PrmRawMaterialOutputHeader.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }



}
