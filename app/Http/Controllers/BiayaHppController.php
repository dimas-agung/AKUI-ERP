<?php

namespace App\Http\Controllers;

//return type View

use App\Models\BiayaHpp;
use Illuminate\View\View;
use App\Models\unit;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class BiayaHppController extends Controller
{
    public function index()
    {

        $i = 1;
        $unit = unit::with('biayahpp')->get();
        $biaya = BiayaHpp::with('unit')->get();
        // return $unit;
        return response()->view('biayahpp.index', [
            'biaya' => $biaya,
            'unit' => $unit,
            'i' => $i
        ]);
    }

    public function create(): View
    {
        return view('biayahpp.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'unit_id'   => 'required',
            'jenis_biaya'   => 'required',
            'biaya_per_gram'   => 'required'
        ], [
            'unit_id.required' => 'Kolom Nama Biaya Wajib diisi.',
            'jenis_biaya.required' => 'Kolom Inisial Biaya Wajib diisi.',
            'biaya_per_gram.required' => 'Kolom Inisial Biaya Wajib diisi.'
        ]);

        //create post
        BiayaHpp::create([
            'unit_id'     => $request->unit_id,
            'jenis_biaya'   => $request->jenis_biaya,
            'biaya_per_gram'   => $request->biaya_per_gram,
        ]);

        //redirect to index
        return redirect()->route('BiayaHpp.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show(string $id): View
    {
        //get post by ID
        $biaya = BiayaHpp::with('unit')->findOrFail($id);
        //render view with post
        return view('biayahpp.Show', compact('biaya'));
    }

    public function edit(string $id): View
    {
        //get post by ID
        $biaya = BiayaHpp::findOrFail($id);
        $unit = unit::with('biayahpp')->get();

        //render view with post
        return view('biayahpp.update', compact('biaya', 'unit'));
    }

    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {


        $biaya = BiayaHpp::findOrFail($id);
        //validate form
        $this->validate($request, [
            'unit_id'           => 'required',
            'jenis_biaya'       => 'required',
            'biaya_per_gram'    => 'required',
            'status'            => 'required'
        ]);

        //get post by ID

        $biaya->update([
            'unit_id'           => $request->unit_id,
            'jenis_biaya'       => $request->jenis_biaya,
            'biaya_per_gram'    => $request->biaya_per_gram,
            'status'            => $request->status
        ]);
        //redirect to index
        return redirect()->route('BiayaHpp.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $biaya = BiayaHpp::findOrFail($id);

        //delete post
        $biaya->delete();

        //redirect to index
        return redirect()->route('BiayaHpp.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
