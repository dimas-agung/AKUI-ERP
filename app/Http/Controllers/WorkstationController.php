<?php

namespace App\Http\Controllers;

//return type View
use Illuminate\View\View;
use App\Models\Workstation;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class WorkstationController extends Controller
{
    public function index(){
        $i =1;
        $workstation = Workstation::all();
        return response()->view('Workstation.index', [
            'workstation' => $workstation,
            'i' => $i,
        ]);
        // return response()->view('layouts.master2');
    }


    /**
     * Create
     */
    public function create(): View
    {
        return view('Workstation.create');
    }

    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'   => 'required|unique:workstation',
        ], [
            'nama.required' => 'Kolom Nama Biaya Wajib diisi.',
        ]);

        //create post
        Workstation::create([
            'nama'   => $request->nama,
        ]);

        //redirect to index
        return redirect()->route('Workstation.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show(string $id): View
    {
        //get post by ID
        $workstation = Workstation::findOrFail($id);

        //render view with post
        return view('Workstation.show', compact('workstation'));
    }


     /**
     * edit
     */
    public function edit(string $id): View
    {
        //get post by ID
        $workstation = Workstation::findOrFail($id);

        //render view with post
        return view('Workstation.update', compact('workstation'));
    }


    /**
     * update
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $workstation = Workstation::findOrFail($id);
        $validasinama = 'required';
        if ($request->nama != $workstation->nama){
            $validasinama = 'required|unique:workstation';
        }
        // validate form
        $validate = $this->validate($request, [
            'nama'             => $validasinama,
            'status'                    => 'required'
        ], [
            'nama.unique'      => 'Nama Workstation Sudah Dipakai.'
        ]);

        //get post by ID
        $workstation->update([
            'nama'   => $request->nama,
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route('Workstation.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $Workstation = Workstation::findOrFail($id);

        //delete post
        $Workstation->delete();

        //redirect to index
        return redirect()->route('Workstation.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
