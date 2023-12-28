<?php

namespace App\Services;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialInputItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialStockService
{
    // public function simpanData($dataStock)
    // {
    //     try {
    //         DB::beginTransaction();

    //         foreach ($dataStock as $itemS) {
    //             $this->createStock($itemS);
    //         }

    //         DB::commit();

    //         return [
    //             'success' => true,
    //             'message' => 'Data berhasil disimpan!',
    //             'redirectTo' => route('prm_raw_material_input.index'), // Ganti dengan nama route yang sesuai
    //         ];
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return [
    //             'success' => false,
    //             'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
    //         ];
    //     }
    // }

    // private function createStock($itemS)
    // {
    //     $itemObject = (object)$itemS;
    //     // Cari item berdasarkan id_box dan nomor_batch
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
}
