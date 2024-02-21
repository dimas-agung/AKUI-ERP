<?php

namespace App\Services;

use App\Models\PreGradingHalusAdding;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreGradingHalusAddingService
{
    public function simpanData($dataArray)
    {
        try {
            DB::beginTransaction();

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('PreGradingHalusAdding.index'), // Ganti dengan nama route yang sesuai
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
        PreGradingHalusAdding::create([
            'nomor_grading'         => $item->nomor_grading,
            'nomor_job'             => $item->nomor_job,
            'id_box_grading_kasar'  => $item->id_box_grading_kasar,
            'id_box_raw_material'   => $item->id_box_raw_material,
            'nomor_batch'           => $item->nomor_batch,
            'nomor_nota_internal'   => $item->nomor_nota_internal,
            'nama_supplier'         => $item->nama_supplier,
            'jenis_raw_material'    => $item->jenis_raw_material,
            'kadar_air'             => $item->kadar_air,
            'jenis_kirim'           => $item->jenis_kirim,
            'berat_kirim'           => $item->berat_kirim,
            'pcs_kirim'             => $item->pcs_kirim,
            'tujuan_kirim'          => $item->tujuan_kirim,
            'modal'                 => $item->modal,
            'total_modal'           => $item->total_modal,
            // 'user_created'          => $item->user_created ?? "Admin123",
            // 'user_updated'          => $item->user_updated ?? "Admin123",
        ]);

        // stok
        $itemObject = (object)$item;
        // Cari item berdasarkan id_box dan nomor_batch
        $existingItem = PreGradingHalusAddingStock::where('id_box', $itemObject->id_box)
            ->where('nomor_batch', $itemObject->nomor_batch)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'unit'                      => $itemObject->unit,
            'nomor_grading'             => $itemObject->nomor_grading,
            'id_box_grading_kasar'      => $itemObject->id_box_grading_kasar,
            'nomor_batch'               => $itemObject->nomor_batch,
            'nomor_nota_internal'       => $itemObject->nomor_nota_internal,
            'nama_supplier'             => $itemObject->nama_supplier,
            'jenis_raw_material'        => $itemObject->jenis_raw_material,
            'kadar_air'                 => $itemObject->kadar_air,
            'berat_adding'              => $itemObject->berat_adding,
            'pcs_adding'                => $itemObject->pcs_adding,
            'modal'                     => $itemObject->modal,
            'total_modal'               => $itemObject->total_modal,
            'status_stock'              => $itemObject->status_stock,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];
        //
        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            $BeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;

            // Update nilai berat_masuk pada item yang sudah ada
            $lastBeratMasuk = $existingItem->berat_masuk += $itemObject->berat_bersih;
            $existingItem->berat_keluar = $itemObject->berat_keluar ?? $existingItem->berat_keluar ?? 0;

            // Tentukan nilai sisa_berat sesuai kondisi
            if ($existingItem->berat_keluar === 0 || $existingItem->berat_keluar === null) {
                // Jika berat_keluar belum diisi, isi sisa_berat dengan nilai berat_masuk
                $existingItem->sisa_berat = (int)$BeratMasuk;
            } else {
                // Jika berat_keluar sudah diisi, hitung sisa berat
                $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
            }

            if ($existingItem->total_modal === 0 || $existingItem->total_modal === null) {
                // tet
                $existingItem->total_modal = $existingItem->modal * $existingItem->sisa_berat;
            } else {
                $existingItem->total_modal = $existingItem->modal * $existingItem->sisa_berat;
            }

            // Update juga kolom-kolom lain yang diperlukan
            $existingItem->nomor_nota_internal = $itemObject->nomor_nota_internal;
            // $existingItem->avg_kadar_air = $itemObject->avg_kadar_air;
            $existingItem->keterangan = $itemObject->keterangan;
            $existingItem->user_created = $itemObject->user_created ?? '';

            // Simpan perubahan pada stok yang sudah ada
            $existingItem->save();
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PreGradingHalusAddingStock::create($dataToUpdate);
        }
    }
    public function deleteData($id)
    {
        try {
            DB::beginTransaction();

            // Lakukan penghapusan berdasarkan ID
            PreGradingHalusAdding::where('id', $id)->delete();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil dihapus!',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menghapus data. ' . $e->getMessage(),
            ];
        }
    }
}
