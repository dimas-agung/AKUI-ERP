<?php

namespace App\Http\Controllers;

use App\Models\MasterJenis;
use Illuminate\Http\Request;
use Illuminate\View\View;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class MasterJenisController extends Controller
{
    //
    public function index()
    {

        $MasterJenis = MasterJenis::all();

        return response()->view('master.MasterJenis', [
            'MasterJenis' => $MasterJenis,
        ]);
    }

    /**
     * create
     *
     * @return View
     */
    public function create()
    {
        return view('master.FormMasterJenis');
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
            'datetime'              => 'required',
            'jenis'                 => 'required',
            'kategori_susut'        => 'required',
            'upah_operator'         => 'required',
            'pengurangan_harga'     => 'required',
            'harga_estimasi'        => 'required',
            'status'                => 'required'
        ]);

        //create MasterSupplier
        MasterJenis::create([
            'datetime'              => $request->datetime,
            'jenis'                 => $request->jenis,
            'kategori_susut'        => $request->kategori_susut,
            'upah_operator'         => $request->upah_operator,
            'pengurangan_harga'     => $request->pengurangan_harga,
            'harga_estimasi'        => $request->harga_estimasi,
            'status'                => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_jenis.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id)
    {
        //get post by ID
        $MasJen = MasterJenis::findOrFail($id);

        //render view with post
        return view('master.DetailMasterJenis', compact('MasJen'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id)
    {
        $MasJen = MasterJenis::findOrFail($id);

        return view('master.EditMasterJenis', compact('MasJen'));
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
        $MasJen = MasterJenis::findOrFail($id);

        //validate form
        $validate = $this->validate($request, [
            'datetime'              => 'required',
            'jenis'                 => 'required',
            'kategori_susut'        => 'required',
            'upah_operator'         => 'required',
            'pengurangan_harga'     => 'required',
            'harga_estimasi'        => 'required',
            'status'                => 'required'
        ]);

        $MasJen->update([
            'datetime'          => $request->datetime,
            'jenis'             => $request->jenis,
            'kategori_susut'    => $request->kategori_susut,
            'upah_operator'     => $request->upah_operator,
            'pengurangan_harga' => $request->pengurangan_harga,
            'harga_estimasi'    => $request->harga_estimasi,
            'status'            => $request->status
        ]);

        //redirect to index
        return redirect()->route('master_jenis.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $MasJen = MasterJenis::findOrFail($id);

        //delete post
        $MasJen->delete();

        //redirect to index
        return redirect()->route('master_jenis.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
