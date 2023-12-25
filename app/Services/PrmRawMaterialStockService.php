<?php

namespace App\Services;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialInputItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialStockService
{
    public function updateOrAddRow($idBox, $data)
    {
        // Cari data berdasarkan id_box
        $existingData = PrmRawMaterialStock::where('id_box', $idBox)->first();

        if ($existingData) {
            // Jika id_box sudah ada, perbarui data yang ada
            $existingData->update($data);
        } else {
            // Jika id_box tidak ada, tambahkan baris baru dengan id_box baru
            PrmRawMaterialStock::create(array_merge($data, ['id_box' => $idBox]));
        }
    }
    // public function simpanDataItem($dataArray)
    // {
    //     try {
    //         DB::beginTransaction();
    //         // $this->createHeader($dataHeader);

    //         foreach ($dataArray as $item) {
    //             $this->createItem($item);
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
}
