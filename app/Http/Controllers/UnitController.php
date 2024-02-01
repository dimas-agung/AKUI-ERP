<?php

namespace App\Http\Controllers;

//return type View
use Illuminate\View\View;
use App\Models\unit;
use App\Models\Workstation;

use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class UnitController extends Controller
{
    public function index()
    {
        $workstation = Workstation::with('unit')->get();
        $unit = unit::with('workstation')->get();
        // return $workstation;
        return response()->view('unit.index', [
            'unit' => $unit,
            'workstation' => $workstation,
        ]);
    }

    // Belum Dilanjutkan untuk CRUD nya

    public function create(): View
    {
        return view('unit.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'workstation_id'   => 'required',
            'nama'   => 'required|unique:unit'
        ], [
            'nama.required' => 'Kolom Nama Biaya Wajib diisi.',
            'workstation_id.required' => 'Kolom Inisial Biaya Wajib diisi.'
        ]);

        //create post
        unit::create([
            'workstation_id'     => $request->workstation_id,
            'nama'   => $request->nama
        ]);

        //redirect to index
        return redirect()->route('index.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show(string $id): View
    {
        //get post by ID
        $unit = Unit::with('workstation')->findOrFail($id);
        //render view with post
        return view('unit.Show', compact('unit'));
    }

    public function edit(string $id): View
    {
        //get post by ID
        $unit = unit::findOrFail($id);
        $workstation = Workstation::with('unit')->get();

        //render view with post
        return view('unit.update', compact('unit', 'workstation'));
    }

    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $unit = unit::findOrFail($id);
        //validate form
        $this->validate($request, [
            'workstation_id'   => 'required',
            'nama'   => 'required',
            'status'   => 'required'
        ]);

        //get post by ID

        $unit->update([
            'workstation_id'     => $request->workstation_id,
            'nama'   => $request->nama,
            'status'   => $request->status
        ]);
        //redirect to index
        return redirect()->route('index.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $unit = unit::findOrFail($id);

        //delete post
        $unit->delete();

        //redirect to index
        return redirect()->route('index.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
