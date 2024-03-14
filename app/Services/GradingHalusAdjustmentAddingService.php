<?php

namespace App\Services;

use App\Models\GradingHalusAdjustmentAdding;
use App\Models\GradingHalusAdjustmentStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Operator;

class GradingHalusAdjustmentAddingService
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
                'redirectTo' => route('GradingHalusAdjustmentAdding.index'), // Ganti dengan nama route yang sesuai
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
        GradingHalusAdjustmentAdding::create([
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
        GradingHalusAdjustmentStock::create([
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

            // Dapatkan nomor_adjustment berdasarkan ID dari tabel GradingHalusAdjustmentAdding
            $nomorAdjustment = GradingHalusAdjustmentAdding::where('id', $id)->value('nomor_adjustment');

            // Hapus data dari tabel GradingHalusAdjustmentAdding berdasarkan ID
            GradingHalusAdjustmentAdding::where('id', $id)->delete();

            // Hapus data dari tabel GradingHalusAdjustmentStock berdasarkan nomor_adjustment
            GradingHalusAdjustmentStock::where('nomor_adjustment', $nomorAdjustment)->delete();

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
