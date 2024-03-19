<?php

namespace App\Services;

use App\Models\GradingHalusAdjustmentAdding;
use App\Models\GradingHalusAdjustmentStock;
use App\Models\GradingHalusStock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Operator;

class GradingHalusAdjustmentAddingService
{
    protected $HppService;

    public function __construct(HppService $HppService)
    {
        $this->HppService = $HppService;
    }
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
            'user_created'              => $item->user_created ?? "There isn't any",
        ]);
        // Update data GradingHalusStock
        $gradingHalusStock = GradingHalusStock::where('id_box_grading_halus', $item->id_box_grading_halus)
            ->where('nomor_batch', $item->nomor_batch)
            ->first();

        if ($gradingHalusStock) {
            $gradingHalusStock->berat_keluar += $item->berat_adding;
            $gradingHalusStock->pcs_keluar += $item->pcs_adding;
            $gradingHalusStock->sisa_berat -= $item->berat_adding;
            $gradingHalusStock->sisa_pcs -= $item->pcs_adding;
            $gradingHalusStock->modal;
            $gradingHalusStock->total_modal;
            $gradingHalusStock->save();
        } else {
            // Jika tidak ada data, Anda bisa menambahkan logika untuk menangani kasus ini
            // Misalnya, memunculkan pesan kesalahan atau menambahkan data baru jika dibutuhkan.
        }

        // Tambahkan item baru ke tabel PreGradingHalusAdding
        GradingHalusAdjustmentStock::create([
            'unit'                      => $item->unit ?? "Grading Halus",
            'nomor_adjustment'          => $item->nomor_adjustment,
            'nomor_batch'               => $item->nomor_batch,
            'berat_adding'              => $item->berat_adding,
            'pcs_adding'                => $item->pcs_adding,
            'modal'                     => $item->modal,
            'total_modal'               => $item->total_modal,
            'user_created'              => $item->user_created,
        ]);
    }

    public function hapus($id)
    {
        try {
            DB::beginTransaction();

            // Ambil data yang akan dihapus
            $adjustment = GradingHalusAdjustmentAdding::findOrFail($id);

            // Hapus data dari GradingHalusAdjustmentAdding
            $adjustment->delete();

            // Hapus data terkait dari GradingHalusAdjustmentStock
            GradingHalusAdjustmentStock::where('nomor_adjustment', $adjustment->nomor_adjustment)
                ->where('nomor_batch', $adjustment->nomor_batch)
                ->delete();

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
