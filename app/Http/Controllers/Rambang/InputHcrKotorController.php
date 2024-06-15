<?php

namespace App\Http\Controllers\Rambang;

use App\Http\Controllers\Controller;
use App\Models\HcrKotorInput;
use App\Models\MasterJenisHcrKotor;
use App\Models\HcrKotorStock;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class InputHcrKotorController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $CBPenerimaan = HcrKotorInput::with('MasterJenisHcrKotor')->get();
        $jenis = MasterJenisHcrKotor::with('InputHcrKotor')->get();
        // return($jenis);

        return response()->view('Rambang.InputHcrKotor.index', [
            'CBPenerimaan' => $CBPenerimaan,
            'jenis' => $jenis,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create(): View
    {
        $CBPenerimaan = HcrKotorInput::with('MasterJenisHcrKotor')->get();
        $stockTGK = MasterJenisHcrKotor::with('InputHcrKotor')->get();
        // return $stockTGK;
        return view('Rambang.InputHcrKotor.create', compact('stockTGK', 'CBPenerimaan'));
    }


    /**
     * store
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'tgl_add'       => 'required|date',
            'jenis'         => 'required',
            'berat'         => 'required|numeric',
            'id_box'        => 'required',
            'keterangan'    => 'nullable',
            'status'        => 'nullable',
            'user_created'  => 'nullable',
            // Anda mungkin perlu menambahkan aturan validasi lainnya sesuai kebutuhan
        ], [
            'tgl_add.required'      => 'Kolom Tanggal Cabut wajib diisi.',
            'tgl_add.date'          => 'Format Tanggal Cabut tidak valid.',
            'jenis.required'        => 'Kolom Jenis Cabut Wajib diisi.',
            'berat.required'        => 'Kolom Berat Wajib diisi.',
            'berat.numeric'         => 'Kolom Berat harus berupa angka.',
            'id_box.required'       => 'Kolom ID Box Wajib diisi.',
            // Anda bisa menambahkan pesan validasi lainnya sesuai kebutuhan
        ]);

        // Cari apakah id_box_hcr_kotor sudah ada dalam database
        $existingStock = HcrKotorStock::where('id_box_hcr_kotor', $request->id_box)->first();

        // Jika sudah ada, update berat_masuk
        if ($existingStock) {
            $existingStock->update([
                'berat_masuk' => $existingStock->berat_masuk + $request->berat,
                'sisa_berat' => $existingStock->sisa_berat + $request->berat, // Jika ada sisa berat, tambahkan juga
            ]);
        } else {
        // Jika belum ada, buat entri baru di StockHcrKotor
        HcrKotorStock::create([
            'unit' => $request->unit ?? 'Rambang',
            'id_box_hcr_kotor' => $request->id_box,
            'tanggal_cabut' => $request->tgl_add,
            'jenis_hcr_kotor' => $request->jenis,
            'berat_masuk' => $request->berat,
            'berat_keluar' => $request->berat_keluar ?? 0,
            'sisa_berat' => $request->berat,
        ]);
    }

        //create post
        HcrKotorInput::create([
            'tanggal_cabut'   => $request->tgl_add,
            'jenis_hcr_kotor'   => $request->jenis,
            'berat_hcr_kotor'   => $request->berat,
            'id_box_hcr_kotor'   => $request->id_box,
            'keterangan'   => $request->keterangan,
            'status'   => $request->status ?? 1,
            'user_created'   => $request->user_created,
        ]);
        // HcrKotorStock::create([
        //     'id_box_hcr_kotor'   => $request->id_box,
        //     'tanggal_cabut'   => $request->tgl_add,
        //     'jenis_hcr_kotor'   => $request->jenis,
        //     'berat_masuk'   => $request->berat,
        //     'berat_keluar'   => $request->berat_keluar ?? 0,
        //     'sisa_berat'   => $request->berat,
        // ]);

        MasterJenisHcrKotor::where('jenis', $request->jenis)->update([
            'status' => $request->status ?? 0,
        ]);
        // MasterJenisHcrKotor::update([
        //     'status'   => $request->status ?? 0,
        // ]);

        //redirect to index
        return redirect()->route('InputHcrKotor.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();
            //get post by id_box_hcr_kotor
            $inputhcr = HcrKotorInput::findOrFail($id);

            $stock = HcrKotorStock::where('id_box_hcr_kotor', '=', $inputhcr->id_box_hcr_kotor)
            ->where('jenis_hcr_kotor', $inputhcr->jenis_hcr_kotor)
            ->first();

            // Hapus data GradingKasarInput
            $inputhcr->delete();

            if ($stock) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                    if ($stock->berat_masuk === 0) {

                        MasterJenisHcrKotor::where('jenis', $inputhcr->jenis_hcr_kotor)->update([
                            'status' => $inputhcr->status ?? 1,
                        ]);

                        $stock->delete();
                    } else {
                        // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                        if ($inputhcr->berat_hcr_kotor >= $stock->berat_masuk) {

                            MasterJenisHcrKotor::where('jenis', $inputhcr->jenis_hcr_kotor)->update([
                                'status' => $inputhcr->status ?? 1,
                            ]);

                            $stock->delete();
                        } else {
                            $beratSebelumnya = $stock->berat_masuk;

                            // Hitung total modal baru berdasarkan perbedaan berat
                            $perbedaanBerat = $beratSebelumnya - $inputhcr->berat_hcr_kotor;
                            $totalModalBaru = $perbedaanBerat - $stock->berat_keluar;

                            // Update data dengan berat dan total modal yang baru
                            $dataToUpdate = [
                                'berat_masuk' => abs($perbedaanBerat),
                                'sisa_berat' => abs($totalModalBaru),
                            ];

                            // Perbarui data
                            $stock->update($dataToUpdate);
                        }
                    }
                }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('InputHcrKotor.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

        //redirect to index
        return redirect()->route('InputHcrKotor.index')->with([
            'success' => false,
            'error' => $e->getMessage(),
            'notification' => [
                'type' => 'error',
                'title' => 'Gagal Menghapus Data',
                'text' => 'Data tidak dapat dihapus karena berat atau total modal dari StockTransitRawMaterial bernilai 0.'
            ]
        ]);
        }
    }

}
