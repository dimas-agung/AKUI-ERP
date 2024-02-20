<?php

namespace App\Http\Controllers;

//return type View
use App\Models\Perusahaan;
use Illuminate\View\View;
use App\Models\unit;
use App\Models\Workstation;

use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function index()
    {
        $i = 1;
        $workstation = Workstation::with('unit')->get();
        $perusahaan = Perusahaan::with('unit')->get();
        $unit = unit::with('perusahaan', 'workstation')->get();
        // return $unit;
        return response()->view('unit.index', [
            'unit' => $unit,
            'workstation' => $workstation,
            'perusahaan' => $perusahaan,
            'i' => $i,
        ]);
    }

    // Belum Dilanjutkan untuk CRUD nya

    public function create(): View
    {
        return view('unit.create');
    }

    public function getWorkstations($perusahaan_id)
    {
        // Ambil workstation berdasarkan perusahaan yang dipilih
        $workstations = Workstation::where('perusahaan_id', $perusahaan_id)->get();

        // Mengembalikan data workstation dalam format JSON
        return response()->json($workstations);
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'workstation_id'   => 'required',
            'perusahaan_id'       => 'required',
            'nama'   => 'required'
        ], [
            'nama.required' => 'Kolom Nama Biaya Wajib diisi.',
            'workstation_id.required' => 'Kolom WorkStation Wajib diisi.',
            'perusahaan_id.required' => 'Kolom Perusahaan Wajib diisi.'
        ]);

        //create post
        unit::create([
            'workstation_id'     => $request->workstation_id,
            'perusahaan_id'     => $request->perusahaan_id,
            'nama'   => $request->nama
        ]);

        //redirect to index
        return redirect()->route('Unit.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $perusahaan = Perusahaan::with('unit')->get();

        //render view with post
        return view('unit.update', compact('unit', 'workstation', 'perusahaan'));
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
            'perusahaan_id'   => 'required',
            'nama'   => 'required',
            'status'   => 'required'
        ]);

        //get post by ID

        $unit->update([
            'workstation_id'     => $request->workstation_id,
            'perusahaan_id'      => $request->perusahaan_id,
            'nama'              => $request->nama,
            'status'            => $request->status
        ]);
        //redirect to index
        return redirect()->route('Unit.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


        /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();
            //get post by ID
            $Unit = Unit::findOrFail($id);

            //delete post
            $Unit->delete();
             // Commit transaksi
             DB::commit();

             return redirect()->route('Unit.index')->with(['success' => 'Data Berhasil Dihapus!']);
         } catch (\Exception $e) {
             // Rollback transaksi jika terjadi kesalahan
             DB::rollback();
            //redirect to index
            return redirect()->route('Unit.index')->with([
                'success' => false,
                'error' => $e->getMessage(),
                'notification' => [
                    'type' => 'error',
                    'title' => 'Gagal Menghapus Data',
                    'text' => 'Data tidak dapat dihapus karena data sudah berada di Biaya HPP.'
            ]
        ]);
    }
}
}
