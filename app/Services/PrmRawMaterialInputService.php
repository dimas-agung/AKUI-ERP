<?php

namespace App\Services;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialInputService
{
    public function simpanData($dataHeader, $dataArray, $dataStock)
    // public function simpanData($dataHeader, $dataArray)
    {
        try {
            DB::beginTransaction();

            $this->createHeader($dataHeader);

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }

            foreach ($dataStock as $itemS) {
                $this->createStock($itemS);
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

    private function createItem($item)
    {
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

    private function createStock($itemS)
    {
        $itemObject = (object)$itemS;
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
            'berat_masuk'   => $itemObject->berat_masuk,
            'berat_keluar'  => $itemObject->berat_keluar,
            'sisa_berat'    => $itemObject->sisa_berat,
            'avg_kadar_air' => $itemObject->avg_kadar_air,
            'modal'         => $itemObject->modal,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
            'user_created'  => $itemObject->user_created,
            // 'user_updated'  => $itemObject->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Jika item sudah ada, perbarui data
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            PrmRawMaterialStock::create($dataToUpdate);
        }
    }
}
