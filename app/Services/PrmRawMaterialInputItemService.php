<?php

namespace App\Services;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialInputItemService
{
    public function simpanDataItem($dataArray)
    {
        try {
            DB::beginTransaction();
            // $this->createHeader($dataHeader);

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('prm_raw_material_input.index'), // Ganti dengan nama route yang sesuai
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }
    }

    private function createItem($item)
    {
        $defaultBeratKeluar = 0;
        $defaultIdBox = 'Asc-1';
        // Creat Prm Raw Material Stock History
        PrmRawMaterialStockHistory::create([
            'id_box'        => $item->id_box,
            'doc_no'        => $defaultIdBox,
            'berat_masuk'   => $item->berat_bersih,
            'berat_keluar'  => $defaultBeratKeluar,
            'sisa_berat'    => $item->selisih_berat,
            'avg_kadar_air' => $item->kadar_air,
            'modal'         => $item->harga_nota,
            'total_modal'   => $item->total_harga_nota,
            'keterangan'    => $item->keterangan_item,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
        PrmRawMaterialInputItem::create([
            // 'doc_no'            => $item->doc_no,
            'jenis'             => $item->jenis,
            'berat_nota'        => $item->berat_nota,
            'berat_kotor'       => $item->berat_kotor,
            'berat_bersih'      => $item->berat_bersih,
            'selisih_berat'     => $item->selisih_berat,
            'kadar_air'         => $item->kadar_air,
            'id_box'            => $item->id_box,
            'harga_nota'        => $item->harga_nota,
            'total_harga_nota'  => $item->total_harga_nota,
            'harga_deal'        => $item->harga_deal,
            'keterangan'        => $item->keterangan,
            'user_created'      => $item->user_created,
            // 'user_updated'      => $item->user_updated
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
    }

    // public function updateItem($request, $id)
    // {
    //     $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);

    //     // Validasi form
    //     $this->validateRequest($request);

    //     // Update item
    //     $PrmRawMOIC->update($request->all());

    //     return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Diubah!']);
    // }

    // protected function validateRequest(Request $request)
    // {
    //     $request->validate([
    //         'doc_no'       => 'required',
    //         'nomor_bstb'   => 'required',
    //         'nomor_batch'  => 'required',
    //         'id_box'       => 'required',
    //         'nama_supplier' => 'required',
    //         'jenis'        => 'required',
    //         'berat'        => 'required',
    //         'kadar_air'    => 'required',
    //         'tujuan_kirim' => 'required',
    //         'letak_tujuan' => 'required',
    //         'inisial_tujuan' => 'required',
    //         'modal'        => 'required',
    //         'total_modal'  => 'required',
    //         'keterangan_item'    => '',
    //         'user_created' => '',
    //         'user_updated' => ''
    //     ], [
    //         'doc_no.required' => 'Kolom Nomer Document Wajib diisi.',
    //         'nomor_bstb.required' => 'Kolom Nomer BSTB Wajib diisi.'
    //     ]);
    // }
}
