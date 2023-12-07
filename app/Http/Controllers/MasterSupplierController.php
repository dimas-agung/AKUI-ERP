<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterSupplier;
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;


class MasterSupplierController extends Controller
{
    /**
     * index
     *
     * @return View
     */

    public function index()
    {

        $MasterSupplier = MasterSupplier::all();
        // return $MasterSupplier;
        return response()->view('master.MasterSupplier', [
            'MasterSupplier' => $MasterSupplier,
        ]);
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('master.FormMasterSupplier');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama_supplier'     => 'required',
            'inisial_supplier'  => 'required',
            'status'            => 'required'
        ]);

        //create MasterSupplier
        MasterSupplier::create([
            'nama_supplier'     => $request->nama_supplier,
            'inisial_supplier'  => $request->inisial_supplier,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_supplier.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $MasSupp = MasterSupplier::findOrFail($id);

        //render view with post
        return view('master.DetailMasterSupplier', compact('MasSupp'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $MasSupp = MasterSupplier::findOrFail($id);

        return view('master.EditMasterSupplier', compact('MasSupp'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //get post by ID
        $MasSupp = MasterSupplier::findOrFail($id);

        //validate form
        $validate = $this->validate($request, [
            'nama_supplier'     => 'required',
            'inisial_supplier'  => 'required',
            'status'            => 'required'
        ]);

        $MasSupp->update([
            'nama_supplier'     => $request->nama_supplier,
            'inisial_supplier'  => $request->inisial_supplier,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_supplier.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $MasSupp = MasterSupplier::findOrFail($id);

        //delete post
        $MasSupp->delete();

        //redirect to index
        return redirect()->route('master_supplier.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
