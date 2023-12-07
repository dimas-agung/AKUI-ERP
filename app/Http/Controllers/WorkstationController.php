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

        $workstation = Workstation::all();
        return response()->view('Workstation', [
            'workstation' => $workstation,
        ]);
    }



    public function create(): View
    {
        return view('create');
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
            'datetime'     => 'required|min:5',
            'nama'   => 'required',
            'status'   => 'required'
        ]);

        //create post
        Workstation::create([
            'datetime'     => $request->datetime,
            'nama'   => $request->nama,
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route('workstation.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function show(string $id): View
    {
        //get post by ID
        $workstation = Workstation::findOrFail($id);

        //render view with post
        return view('show', compact('workstation'));
    }


     /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $workstation = Workstation::findOrFail($id);

        //render view with post
        return view('edit', compact('workstation'));
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
        $workstation = Workstation::findOrFail($id);
        //validate form
        $this->validate($request, [
            'datetime'     => 'required|min:5',
            'nama'   => 'required',
            'status'   => 'required'
        ]);

        //get post by ID

        $workstation->update([
            'datetime'     => $request->datetime,
            'nama'   => $request->nama,
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route('workstation.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $workstation = Workstation::findOrFail($id);

        //delete post
        $workstation->delete();

        //redirect to index
        return redirect()->route('workstation.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
