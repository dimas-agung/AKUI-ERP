<?php

namespace App\Http\Controllers\PurchasingExim;

//return type View
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class StockTransitGradingKasarController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $stockTGK = StockTransitGradingKasar::get();
        return response()->view('purchasing_exim.StockTransitGradingKasar.index', [
            'stockTGK' => $stockTGK,
            'i' => $i,
        ]);
    }


        /**
     * Create
     */
    public function create(): View
    {
        return view('purchasing_exim.StockTransitGradingKasar.create');
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nomor_bstb'=> 'required',
            'nama_supplier'=> 'required|unique:stock_transit_grading_kasars',
            'jenis'=> '',
            'berat'=> '',
            'kadar_air'=> '',
            'tujuan_kirim'=> '',
            'letak_tujuan'=> '',
            'inisial_tujuan'=> '',
            'modal'=> '',
            'total_modal'=> '',
            'keterangan'=> '',
            'user_created'=> '',
            'user_updated'=> '',
        ], [
            'nomor_bstb.required' => 'Kolom nomor_bstb Biaya Wajib diisi.',
            'nama_supplier.required' => 'Kolom nama_supplier Biaya Wajib diisi.'
        ]);

        //create post
        StockTransitGradingKasar::create([
            'nomor_bstb'   => $request->nomor_bstb,
            'nama_supplier'   => $request->nama_supplier,
            'jenis'   => $request->jenis,
            'berat'   => $request->berat,
            'kadar_air'   => $request->kadar_air,
            'tujuan_kirim'   => $request->tujuan_kirim,
            'letak_tujuan'   => $request->letak_tujuan,
            'inisial_tujuan'   => $request->inisial_tujuan,
            'modal'   => $request->modal,
            'total_modal'   => $request->total_modal,
            'keterangan'   => $request->keterangan,
            'user_created'   => $request->user_created,
            'user_updated'   => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('StockTransitGradingKasar.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show(string $id): View
    {
        //get post by ID
        $stockTGK = StockTransitGradingKasar::findOrFail($id);

        //render view with post
        return view('purchasing_exim.StockTransitGradingKasar.show', compact('stockTGK'));
    }


     /**
     * edit
     */
    public function edit(string $id): View
    {
        //get post by ID
        $stockTGK = StockTransitGradingKasar::findOrFail($id);

        //render view with post
        return view('purchasing_exim.StockTransitGradingKasar.update', compact('stockTGK'));
    }

    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $stockTGK = StockTransitGradingKasar::findOrFail($id);
        //validate form
        $this->validate($request, [
            'nomor_bstb'=> 'required',
            'nama_supplier'=> 'required',
            'jenis'=> 'required',
            'berat'=> 'required',
            'kadar_air'=> 'required',
            'tujuan_kirim'=> 'required',
            'letak_tujuan'=> 'required',
            'inisial_tujuan'=> 'required',
            'modal'=> 'required',
            'total_modal'=> 'required',
            'keterangan'=> 'required',
            'user_created'=> 'required',
            'user_updated'=> 'required'
        ]);

        //get post by ID

        $stockTGK->update([
            'nomor_bstb'   => $request->nomor_bstb,
            'nama_supplier'   => $request->nama_supplier,
            'jenis'   => $request->jenis,
            'berat'   => $request->berat,
            'kadar_air'   => $request->kadar_air,
            'tujuan_kirim'   => $request->tujuan_kirim,
            'letak_tujuan'   => $request->letak_tujuan,
            'inisial_tujuan'   => $request->inisial_tujuan,
            'modal'   => $request->modal,
            'total_modal'   => $request->total_modal,
            'keterangan'   => $request->keterangan,
            'user_created'   => $request->user_created,
            'user_updated'   => $request->user_updated
        ]);

        //redirect to index
        return redirect()->route('StockTransitGradingKasar.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


        /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $stockTGK = StockTransitGradingKasar::findOrFail($id);

        //delete post
        $stockTGK->delete();

        //redirect to index
        return redirect()->route('StockTransitGradingKasar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }



}
