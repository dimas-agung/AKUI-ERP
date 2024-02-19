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
    }
}
