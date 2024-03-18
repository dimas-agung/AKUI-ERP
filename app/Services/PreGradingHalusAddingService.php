<?php

namespace App\Services;

use App\Models\PreGradingHalusAdding;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Operator;

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
        // Tambahkan item baru ke tabel PreGradingHalusAdding
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
            'user_created'          => $item->user_created ?? "There isn't any",
            // 'user_updated'          => $item->user_updated ?? "Admin123",
        ]);

        // Cari item stok berdasarkan nomor grading
        $existingItem = PreGradingHalusAddingStock::where('nomor_grading', $item->nomor_grading)->first();

        if ($existingItem) {
            // Jika item stok sudah ada, update data stok
            $existingItem->berat_adding += $item->berat_adding;
            $existingItem->pcs_adding += $item->pcs_adding;
            $existingItem->modal += $item->modal;
            $existingItem->total_modal += $item->total_modal;
            $existingItem->save();
        } else {
            // Jika item stok belum ada, buat item stok baru
            PreGradingHalusAddingStock::create([
                'unit'                  => $item->unit ?? "Grading Halus",
                'nomor_grading'         => $item->nomor_grading,
                'id_box_grading_kasar'  => $item->id_box_grading_kasar,
                'id_box_raw_material'   => $item->id_box_raw_material,
                'nomor_batch'           => $item->nomor_batch,
                'nomor_nota_internal'   => $item->nomor_nota_internal,
                'nama_supplier'         => $item->nama_supplier,
                'jenis_raw_material'    => $item->jenis_raw_material,
                'kadar_air'             => $item->kadar_air,
                'berat_adding'          => $item->berat_adding,
                'pcs_adding'            => $item->pcs_adding,
                'modal'                 => $item->modal,
                'total_modal'           => $item->total_modal,
                'status_stock'          => $item->status_stock ?? "Aktif",
                // Sesuaikan dengan kolom-kolom lain di tabel stok Anda
            ]);
        }
    }

    public function deleteData($id)
    {
        try {
            DB::beginTransaction();

            // Dapatkan nomor grading yang akan dihapus
            $nomorGrading = PreGradingHalusAdding::where('id', $id)->value('nomor_grading');

            // Lakukan penghapusan data dari PreGradingHalusAdding
            PreGradingHalusAdding::where('id', $id)->delete();

            // Hapus data dari PreGradingHalusAddingStock yang memiliki nomor grading yang sama
            PreGradingHalusAddingStock::where('nomor_grading', $nomorGrading)->delete();

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
