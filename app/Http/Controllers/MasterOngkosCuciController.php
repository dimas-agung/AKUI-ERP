<?php

namespace App\Http\Controllers;

use App\Models\MasterOngkosCuci;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MasterOngkosCuciController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterOngkosCuci = MasterOngkosCuci::all();
        return response()->view('master.master_ongkos_cuci.index', [
            'MasterOngkosCuci' => $MasterOngkosCuci,
            'i' => $i
        ]);
    }
    // store
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $this->validate(
            $request,
            [
                'unit'               => 'required',
                'jenis_bulu'         => 'required|unique:master_ongkos_cucis',
                'biaya_per_gram'     => 'required',
            ],
            [
                'jenis_bulu.unique' => 'Jenis bulu sudah digunakan.',
            ]
        );

        // Create MasterSupplier
        MasterOngkosCuci::create([
            'unit'                  => $request->unit,
            'jenis_bulu'            => $request->jenis_bulu,
            'biaya_per_gram'        => $request->biaya_per_gram,
        ]);

        // Redirect to index
        return redirect()->route('MasterOngkosCuci.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // show
    public function show(string $id)
    {
        //get by ID
        $MasterOngkosCuci = MasterOngkosCuci::findOrFail($id);

        //render view
        return view('master.master_ongkos_cuci.show', compact('MasterOngkosCuci'));
    }
    // edit
    public function edit(string $id)
    {
        $MasterOngkosCuci = MasterOngkosCuci::findOrFail($id);

        return view('master.master_ongkos_cuci.update', compact('MasterOngkosCuci'));
    }
    // update
    public function update(Request $request, $id): RedirectResponse
    {
        //get by ID
        $MasterOngkosCuci = MasterOngkosCuci::findOrFail($id);
        $ValidasiJenisBulu = 'required';
        if ($request->jenis_bulu != $MasterOngkosCuci->jenis_bulu) {
            $ValidasiJenisBulu = 'required|unique:master_ongkos_cucis';
        }

        //validate form
        $validate = $this->validate($request, [
            'unit'                  => 'required',
            'jenis_bulu'            => $ValidasiJenisBulu,
            'biaya_per_gram'        => 'required',
        ], [
            'jenis_bulu' => 'Jenis Sudah Digunakan'
        ]);

        $MasterOngkosCuci->update([
            'unit'                  => $request->unit,
            'jenis_bulu'            => $request->jenis_bulu,
            'biaya_per_gram'        => $request->biaya_per_gram,
            'status'                => $request->status
        ]);

        //redirect to index
        return redirect()->route('MasterOngkosCuci.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    // destroy
    public function destroy($id): RedirectResponse
    {
        //get by ID
        $MasterOngkosCuci = MasterOngkosCuci::findOrFail($id);

        //delete
        $MasterOngkosCuci->delete();

        //redirect to index
        return redirect()->route('MasterOngkosCuci.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
