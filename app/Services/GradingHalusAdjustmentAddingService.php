<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\GradingHalusInput;
use App\Models\GradingHalusStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use PHPUnit\Framework\Constraint\Operator;
use App\Models\GradingHalusAdjustmentStock;
use App\Models\GradingHalusAdjustmentAdding;
use App\Models\GradingHalusAdjustmentInput;

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

            // Ambil PreGradingHalusAdding berdasarkan nomor_job dan id_box_grading_kasar
            $GradingHalusAdjustmentAdding = GradingHalusAdjustmentAdding::where('id_box_grading_halus', $dataArray[0]->id_box_grading_halus)
                ->where('nomor_batch', $dataArray[0]->nomor_batch)
                ->first();

            // Ambil PreGradingHalusInput berdasarkan nomor_job dan id_box_grading_kasar dari PreGradingHalusAdding
            $GradingHalusInput = GradingHalusInput::where('id_box_grading_halus', $GradingHalusAdjustmentAdding->id_box_grading_halus)
                ->where('nomor_batch', $GradingHalusAdjustmentAdding->nomor_batch)
                ->first();

            if ($GradingHalusInput) {
                $GradingHalusInput->update([
                    'status' => 0,
                ]);
            }

            $GradingHalusAdjustmentInput = GradingHalusAdjustmentInput::where('id_box_grading_halus', $GradingHalusAdjustmentAdding->id_box_grading_halus)
                ->where('nomor_batch', $GradingHalusAdjustmentAdding->nomor_batch)
                ->first();

            if ($GradingHalusAdjustmentInput) {
                $GradingHalusAdjustmentInput->update([
                    'status' => 0,
                ]);
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
            $gradingHalusStock->total_modal = $gradingHalusStock->sisa_berat* $gradingHalusStock->modal;
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
            'user_created'              => $item->user_created ?? "There isn't any",
        ]);
    }

    public function destroy($id)
    {
        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Temukan record berdasarkan id
            $GradingHalusAdjustmentAdding = GradingHalusAdjustmentAdding::findOrFail($id);

            // Hapus semua item terkait
            $stockPRM = GradingHalusAdjustmentStock::where('nomor_adjustment', '=', $GradingHalusAdjustmentAdding->nomor_adjustment)
                ->where('nomor_batch', $GradingHalusAdjustmentAdding->nomor_batch)
                ->first();

            if ($stockPRM) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                if ($stockPRM->status === 1) {
                    $stockPRM->delete();
                } else {
                    // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                    if ($GradingHalusAdjustmentAdding->berat_adding >= $stockPRM->berat_masuk) {
                        $stockPRM->delete();
                    }
                }
            }

            $existingItems = GradingHalusStock::where('id_box_grading_halus', $GradingHalusAdjustmentAdding->id_box_grading_halus)
                ->where('nomor_batch', $GradingHalusAdjustmentAdding->nomor_batch)
                ->get();

            // Logika Update Status
            foreach ($existingItems as $existingItem) {
                if ($existingItem) {
                    $beratSebelumnya = $existingItem->berat_keluar;
                    $pcsSebelumnya = $existingItem->pcs_keluar;

                    $perbedaanBerat = $beratSebelumnya - $GradingHalusAdjustmentAdding->berat_adding;
                    $perbedaanPcs = $pcsSebelumnya - $GradingHalusAdjustmentAdding->pcs_adding;
                    $sisaBerat = $existingItem->berat_masuk - $perbedaanBerat;
                    $sisaPcs = $existingItem->pcs_masuk - $perbedaanPcs;
                    $totalModalBaru = $sisaBerat * $GradingHalusAdjustmentAdding->modal;

                    $existingItem->update([
                        'berat_keluar' => $perbedaanBerat,
                        'sisa_berat' => $sisaBerat,
                        'pcs_keluar' => $perbedaanPcs,
                        'sisa_pcs' => $sisaPcs,
                        'total_modal' => $totalModalBaru,
                        'status' => 1,
                    ]);
                }
            }

            $GradingHalusInput = GradingHalusInput::where('id_box_grading_halus', $GradingHalusAdjustmentAdding->id_box_grading_halus)
                ->where('nomor_batch', $GradingHalusAdjustmentAdding->nomor_batch)
                ->get();

            // Logika Update Status
            foreach ($GradingHalusInput as $item) {
                if ($item) {

                    $item->update([
                        'status' => 1,
                    ]);
                }
            }

            $GradingHalusAdjustmentInput = GradingHalusAdjustmentInput::where('id_box_grading_halus', $GradingHalusAdjustmentAdding->id_box_grading_halus)
                ->where('nomor_batch', $GradingHalusAdjustmentAdding->nomor_batch)
                ->get();

            // Logika Update Status
            foreach ($GradingHalusAdjustmentInput as $item) {
                if ($item) {

                    $item->update([
                        'status' => 1,
                    ]);
                }
            }

            // Hapus record utama
            $GradingHalusAdjustmentAdding->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return ['success' => true];
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
