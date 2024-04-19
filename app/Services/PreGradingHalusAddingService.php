<?php

namespace App\Services;

use App\Models\PreGradingHalusAdding;
use App\Models\PreGradingHalusAddingStock;
use App\Models\PreGradingHalusStock;
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

        // $existingItem = PreGradingHalusAddingStock::where('nomor_grading', $item->nomor_grading)->first();

        // if ($existingItem) {
        //     // Jika item stok sudah ada, update data stok
        //     $existingItem->berat_kirim += $item->berat_kirim;
        //     $existingItem->pcs_kirim += $item->pcs_kirim;
        //     $existingItem->$item->total_modal / $item->berat_kirim;
        //     $existingItem->total_modal += $item->total_modal;
        //     $existingItem->save();
        // } else {
        //     // Jika item stok belum ada, buat item stok baru
        //     PreGradingHalusAddingStock::create([
        //         'unit'                  => $item->unit ?? "Grading Halus",
        //         'nomor_grading'         => $item->nomor_grading,
        //         'id_box_grading_kasar'  => $item->id_box_grading_kasar,
        //         'nomor_batch'           => $item->nomor_batch,
        //         'nomor_nota_internal'   => $item->nomor_nota_internal,
        //         'nama_supplier'         => $item->nama_supplier,
        //         'jenis_raw_material'    => $item->jenis_raw_material,
        //         'kadar_air'             => $item->kadar_air,
        //         'berat_adding'          => $item->berat_kirim,
        //         'pcs_adding'            => $item->pcs_kirim,
        //         'modal'                 => $item->modal,
        //         'total_modal'           => $item->total_modal,
        //         'status_stock'          => $item->status_stock ?? 1,
        //     ]);
        // }

        // Ambil semua entri dari PreGradingHalusAdding yang sesuai dan kelompokkan berdasarkan nomor_grading
        $itemsGrouped = PreGradingHalusAdding::groupBy('nomor_grading')
            ->selectRaw('nomor_grading, SUM(total_modal) as total_modal, SUM(berat_kirim) as total_berat_kirim, SUM(pcs_kirim) as total_pcs_kirim')
            ->get();

        foreach ($itemsGrouped as $group) {
            // Ambil semua item dengan nomor grading yang sama
            $items = PreGradingHalusAdding::where('nomor_grading', $group->nomor_grading)->get();

            // Lakukan iterasi untuk setiap item dalam grup dan simpan hasil perhitungan ke dalam PreGradingHalusAddingStock
            foreach ($items as $item) {
                PreGradingHalusAddingStock::create([
                    'unit'                  => $item->unit ?? "Grading Halus",
                    'nomor_grading'         => $item->nomor_grading,
                    'id_box_grading_kasar'  => $item->id_box_grading_kasar,
                    'nomor_batch'           => $item->nomor_batch,
                    'nomor_nota_internal'   => $item->nomor_nota_internal,
                    'nama_supplier'         => $item->nama_supplier,
                    'jenis_raw_material'    => $item->jenis_raw_material,
                    'kadar_air'             => $item->kadar_air,
                    'berat_adding'          => $group->total_berat_kirim,
                    'pcs_adding'            => $group->total_pcs_kirim,
                    'modal'                 => $item->modal,
                    'total_modal'           => $group->total_modal,
                    'status_stock'          => $item->status_stock ?? 1,
                    // Tambahkan properti lain yang sesuai dengan struktur tabel Anda
                ]);
            }
        }



        // test Pre Grading Halus Stock
        $itemObject = (object)$item;
        $existingItem = PreGradingHalusStock::where('nomor_job', $itemObject->nomor_job)
            ->where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
            ->first();

        $dataToUpdate = [
            'total_modal'   => $itemObject->total_modal,
            'user_updated'  => $itemObject->user_created ?? "Tes",
        ];

        if ($existingItem) {
            $tambahBeratKeluar = $existingItem->berat_keluar + $itemObject->berat_kirim;
            $tambahPcsKeluar = $existingItem->pcs_keluar + $itemObject->pcs_kirim;

            $totalModalBaru = $tambahBeratKeluar * $itemObject->modal;

            $dataToUpdate['berat_keluar'] = $tambahBeratKeluar;
            $dataToUpdate['pcs_keluar'] = $tambahPcsKeluar;
            $dataToUpdate['sisa_berat'] = $existingItem->berat_masuk - $tambahBeratKeluar;
            $dataToUpdate['sisa_pcs'] = $existingItem->pcs_masuk - $tambahPcsKeluar;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PreGradingHalusStock::create(array_merge($dataToUpdate, [
                'unit'                              => $item->unit ?? "Pre Cleaning",
                'nomor_job'                         => $item->nomor_job,
                'id_box_grading_kasar'              => $item->id_box_grading_kasar,
                'nomor_bstb'                        => $item->nomor_bstb,
                'id_box_raw_material'               => $item->id_box_raw_material,
                'nomor_batch'                       => $item->nomor_batch,
                'nomor_nota_internal'               => $item->nomor_nota_internal,
                'nama_supplier'                     => $item->nama_supplier,
                'jenis_raw_material'                => $item->jenis_raw_material,
                'kadar_air'                         => $item->kadar_air,
                'jenis_kirim'                       => $item->jenis_kirim,
                'berat_masuk'                       => $item->berat_masuk ?? 0,
                'pcs_masuk'                         => $item->pcs_masuk ?? 0,
                'sisa_berat'                        => $item->berat_masuk - $item->berat_kirim,
                'sisa_pcs'                          => $item->pcs_masuk - $item->pcs_kirim,
                'tujuan_kirim'                      => $item->tujuan_kirim,
                'modal'                             => $item->modal,
                'user_created'                      => $item->user_created ?? "There isn't any",
            ]));
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
