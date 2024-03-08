<?php

namespace App\Services;

use App\Models\AdjustmentAdding;
use App\Models\AdjustmentStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Operator;

class AdjustmentAddingService
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
                'redirectTo' => route('AdjustmentAdding.index'), // Ganti dengan nama route yang sesuai
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
        AdjustmentAdding::create([
            'id_box_grading_halus'      => $item->id_box_grading_halus,
            'nomor_adjustment'          => $item->nomor_adjustment,
            'nomor_batch'               => $item->nomor_batch,
            'jenis_adding'              => $item->jenis_adding,
            'berat_adding'              => $item->berat_adding,
            'pcs_adding'                => $item->pcs_adding,
            'sisa_berat'                => $item->sisa_berat,
            'sisa_pcs'                  => $item->sisa_pcs,
            'keterangan'                => $item->keterangan,
            'modal'                     => $item->modal,
            'total_modal'               => $item->total_modal,
        ]);
        // Tambahkan item baru ke tabel PreGradingHalusAdding
        AdjustmentStock::create([
            'unit'                      => $item->unit ?? "Grading Halus",
            'nomor_adjustment'          => $item->nomor_adjustment,
            'nomor_batch'               => $item->nomor_batch,
            'berat_adding'              => $item->berat_adding,
            'pcs_adding'                => $item->pcs_adding,
            'modal'                     => $item->modal,
            'total_modal'               => $item->total_modal,
        ]);
    }
    public function hapusData($id)
    {
        try {
            DB::beginTransaction();

            // Hapus data dari tabel AdjustmentAdding berdasarkan ID
            AdjustmentAdding::where('id', $id)->delete();

            // Hapus data dari tabel AdjustmentStock berdasarkan nomor_adjustment
            AdjustmentStock::where('nomor_adjustment', $id)->delete();

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
