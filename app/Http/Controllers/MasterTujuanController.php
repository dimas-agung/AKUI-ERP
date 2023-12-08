<?php

namespace App\Http\Controllers;

use App\Models\MasterTujuan;
use Illuminate\Http\Request;
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class MasterTujuanController extends Controller
{
    //
    public function index()
    {

        $MasterTujuan = MasterTujuan::all();

        return response()->view('master.MasterTujuan', [
            'MasterTujuan' => $MasterTujuan,
        ]);
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('master.FormMasterTujuan');
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
            'tujuan_kirim'      => 'required',
            'letak_tujuan'      => 'required',
            'inisial_tujuan'    => 'required',
            'status'            => 'required'
        ]);

        //create MasterSupplier
        MasterTujuan::create([
            'tujuan_kirim'      => $request->tujuan_kirim,
            'letak_tujuan'      => $request->letak_tujuan,
            'inisial_tujuan'    => $request->inisial_tujuan,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_tujuan.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $MasTu = MasterTujuan::findOrFail($id);

        //render view with post
        return view('master.DetailMasterTujuan', compact('MasTu'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $MasTu = MasterTujuan::findOrFail($id);

        return view('master.EditMasterTujuan', compact('MasTu'));
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
        $MasTu = MasterTujuan::findOrFail($id);

        //validate form
        $validate = $this->validate($request, [
            'tujuan_kirim'      => 'required',
            'letak_tujuan'      => 'required',
            'inisial_tujuan'    => 'required',
            'status'            => 'required'
        ]);

        $MasTu->update([
            'tujuan_kirim'      => $request->tujuan_kirim,
            'letak_tujuan'      => $request->letak_tujuan,
            'inisial_tujuan'    => $request->inisial_tujuan,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_tujuan.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $MasTu = MasterTujuan::findOrFail($id);

        //delete post
        $MasTu->delete();

        //redirect to index
        return redirect()->route('master_tujuan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
