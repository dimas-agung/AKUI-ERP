<?php

namespace App\Services;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStockHistory;
use App\Models\PrmRawMaterialStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialInputService
{
    // public function simpanData($dataHeader, $dataArray, $dataStock)
    // public function simpanData($dataHeader, $dataArray, $dataStock, $dataStockHistory)
    public function simpanData($dataHeader, $dataArray)
    {
        try {
            DB::beginTransaction();

            $this->createHeader($dataHeader);

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }
            // foreach ($dataStock as $itemS) {
            //     $this->createStock($itemS);
            // }

            // foreach ($dataStockHistory as $itemH) {
            //     $this->createStockHistory($itemH);
            // }

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

    private function createHeader($dataHeader)
    {
        PrmRawMaterialInput::create([
            // 'doc_no'                => $dataHeader[0]->doc_no,
            'nomor_po'              => $dataHeader->nomor_po,
            'nomor_batch'           => $dataHeader->nomor_batch,
            'nomor_nota_supplier'   => $dataHeader->nomor_nota_supplier,
            'nomor_nota_internal'   => $dataHeader->nomor_nota_internal,
            'nama_supplier'         => $dataHeader->nama_supplier,
            'keterangan'            => $dataHeader->keterangan,
            'user_created'          => $dataHeader->user_created,
            // 'user_updated'          => $dataHeader[0]->user_updated
            // Sesuaikan dengan kolom-kolom lain di tabel header Anda
        ]);
    }

    // private function createItem($item)
    // {
    //     PrmRawMaterialInputItem::create([
    //         // 'doc_no'            => $item->doc_no,
    //         'jenis'             => $item->jenis,
    //         'berat_nota'        => $item->berat_nota,
    //         'berat_kotor'       => $item->berat_kotor,
    //         'berat_bersih'      => $item->berat_bersih,
    //         'selisih_berat'     => $item->selisih_berat,
    //         'kadar_air'         => $item->kadar_air,
    //         'id_box'            => $item->id_box,
    //         'harga_nota'        => $item->harga_nota,
    //         'total_harga_nota'  => $item->total_harga_nota,
    //         'harga_deal'        => $item->harga_deal,
    //         'keterangan'        => $item->keterangan,
    //         'user_created'      => $item->user_created,
    //         // 'user_updated'      => $item->user_updated
    //         // Sesuaikan dengan kolom-kolom lain di tabel item Anda
    //     ]);
    // }

    private function createItem($item)
    {
        $defaultBeratKeluar = 0;
        // $defaultIdBox = '';
        // Creat Prm Raw Material Stock History
        PrmRawMaterialStockHistory::create([
            'id_box'        => $item->id_box,
            // 'doc_no'        => $defaultIdBox,
            'berat_masuk'   => $item->berat_bersih,
            'berat_keluar'  => $defaultBeratKeluar,
            'sisa_berat'    => $item->selisih_berat,
            'avg_kadar_air' => $item->kadar_air,
            'modal'         => $item->harga_nota,
            'total_modal'   => $item->total_harga_nota,
            'keterangan'    => $item->keterangan,
            'user_created'  => $item->user_created,
            // 'user_updated'  => $item->user_updated,
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

        // stok
        $itemObject = (object)$item;
        // Cari item berdasarkan id_box dan nomor_batch
        $existingItem = PrmRawMaterialStock::where('id_box', $itemObject->id_box)
            ->where('nomor_batch', $itemObject->nomor_batch)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'id_box'        => $itemObject->id_box,
            'nomor_batch'   => $itemObject->nomor_batch,
            'nama_supplier' => $itemObject->nama_supplier,
            'jenis'         => $itemObject->jenis,
            'berat_masuk'   => $itemObject->berat_bersih,
            'berat_keluar'  => $itemObject->berat_keluar ?? 0,
            'sisa_berat'    => $itemObject->sisa_berat ?? 0,
            'avg_kadar_air' => $itemObject->kadar_air,
            'modal'         => $itemObject->modal ?? 0,
            'total_modal'   => $itemObject->total_modal ?? 0,
            'keterangan'    => $itemObject->keterangan,
            'user_created'  => $itemObject->user_created,
            // 'user_updated'  => $itemObject->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];
        //
        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            // $lastBeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;

            // Update nilai berat_masuk pada item yang sudah ada
            $lastBeratMasuk = $existingItem->berat_masuk += $itemObject->berat_bersih;
            $existingItem->berat_keluar = $itemObject->berat_keluar ?? $existingItem->berat_keluar ?? 0;

            // Tentukan nilai sisa_berat sesuai kondisi
            if ($existingItem->berat_keluar === null || $existingItem->berat_keluar === 0) {
                // Jika berat_keluar belum diisi, isi sisa_berat dengan nilai berat_masuk
                $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
            } else {
                // Jika berat_keluar sudah diisi, hitung sisa berat
                $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
            }

            // Update juga kolom-kolom lain yang diperlukan
            $existingItem->avg_kadar_air = $itemObject->kadar_air;
            $existingItem->modal = $itemObject->modal ?? $existingItem->modal ?? 0;
            $existingItem->total_modal = $itemObject->total_modal ?? $existingItem->total_modal ?? 0;
            $existingItem->keterangan = $itemObject->keterangan;
            $existingItem->user_created = $itemObject->user_created;

            // Simpan perubahan pada stok yang sudah ada
            $existingItem->save();
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PrmRawMaterialStock::create($dataToUpdate);
        }
    }

    // private function createStock($itemS)
    // {
    //     $itemObject = (object)$itemS;
    //     $existingItem = PrmRawMaterialStock::where('id_box', $itemObject->id_box)
    //         ->where('nomor_batch', $itemObject->nomor_batch)
    //         ->first();
    //     // return $existingItem

    //     $dataToUpdate = [
    //         'id_box'        => $itemObject->id_box,
    //         'nomor_batch'   => $itemObject->nomor_batch,
    //         'nama_supplier' => $itemObject->nama_supplier,
    //         'jenis'         => $itemObject->jenis,
    //         'berat_masuk'   => $itemObject->berat_masuk,
    //         'berat_keluar'  => $itemObject->berat_keluar,
    //         'sisa_berat'    => $itemObject->sisa_berat,
    //         'avg_kadar_air' => $itemObject->avg_kadar_air,
    //         'modal'         => $itemObject->modal,
    //         'total_modal'   => $itemObject->total_modal,
    //         'keterangan'    => $itemObject->keterangan,
    //         'user_created'  => $itemObject->user_created,
    //         // 'user_updated'  => $itemObject->user_updated,
    //         // Sesuaikan dengan kolom-kolom lain di tabel item Anda
    //     ];

    //     if ($existingItem) {
    //         // Jika item sudah ada, perbarui data
    //         $existingItem->update($dataToUpdate);
    //     } else {
    //         // Jika item tidak ada, buat item baru
    //         PrmRawMaterialStock::create($dataToUpdate);
    //     }
    // }
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
