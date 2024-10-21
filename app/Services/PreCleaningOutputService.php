<?php

namespace App\Services;

use App\Models\PreCleaningInput;
use App\Models\PreCleaningOutput;
use App\Models\PreCleaningStock;
use App\Models\TransitPreCleaningStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreCleaningOutputService
{
    public function simpanData($dataArray)
    {
        try {
            DB::beginTransaction();
            $dataTotalBerat = [];
            foreach ($dataArray as $item) {
                $dataTotalBerat[$item->nomor_job] = 0;
            }
            foreach ($dataArray as $item) {
                $dataTotalBerat[$item->nomor_job] += $item->berat_grading;
            }
            foreach ($dataArray as $item) {
                $item->total_berat_grading = $dataTotalBerat[$item->nomor_job];
                $this->createItem($item);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('PreCleaningOutput.index'), // Ganti dengan nama route yang sesuai
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
        PreCleaningOutput::create([
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
            'berat_kirim'                       => $item->berat_kirim,
            'pcs_kirim'                         => $item->pcs_kirim,
            'jenis_kirim'                       => $item->jenis_kirim,
            'berat_grading'                       => $item->berat_grading,
            'pcs_grading'                         => $item->pcs_grading,
            'tujuan_kirim'                      => $item->tujuan_kirim,
            'modal'                             => $item->modal,
            'total_modal'                       => $item->total_modal,
            'operator_sikat_n_kompresor'        => $item->operator_sikat_n_kompresor,
            'operator_flek_n_poles'             => $item->operator_flek_n_poles,
            'operator_cutter'                   => $item->operator_cutter,
            'jenis_grading'                => $item->jenis_grading,
            'berat_grading'                => $item->berat_grading,
            'pcs_grading'                  => $item->pcs_grading,
            'susut'                             => (1 - ($item->total_berat_grading/$item->berat_kirim)),
            'keterangan'                        => $item->keterangan,
            'nomor_grading'                     => $item->nomor_grading ?? "UGK_TES",
            'user_created'                      => $item->user_created,
        ]);

        $itemObject = (object)$item;
        $existingItem = TransitPreCleaningStock::where('nomor_job', $itemObject->nomor_job)
            ->where('jenis_grading', $itemObject->jenis_grading)
            ->first();

        $dataToUpdate = [
            'berat_grading'   => $itemObject->berat_grading,
            'pcs_grading'     => $itemObject->pcs_grading,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
        ];

        if ($existingItem) {
            $sisaBeratBaru = $existingItem->sisa_berat + $itemObject->berat_grading;
            $totalModalBaru =  $sisaBeratBaru * $itemObject->modal;

            $dataToUpdate['berat_grading'] = $existingItem->berat_grading + $itemObject->berat_grading;
            $dataToUpdate['pcs_grading'] = $existingItem->pcs_grading + $itemObject->pcs_grading;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $dataToUpdate['sisa_berat'] = $sisaBeratBaru;

            $existingItem->update($dataToUpdate);
        } else {
            TransitPreCleaningStock::create(array_merge($dataToUpdate, [
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
                'berat_kirim'                       => $item->berat_kirim,
                'pcs_kirim'                         => $item->pcs_kirim,
                'jenis_grading'                       => $item->jenis_grading,
                'berat_grading'                       => $item->berat_grading,
                'pcs_grading'                         => $item->pcs_grading,
                'tujuan_kirim'                      => $item->tujuan_kirim,
                'modal'                             => $item->modal,
                'total_modal'                       => $item->total_modal,
                'sisa_berat'                        => $item->berat_grading, // Jika baru, maka sisa_berat sama dengan berat_kirim
                'keterangan'                        => $item->keterangan,
                'nomor_grading'                     => $item->nomor_grading ?? "UGK_TES",
                'user_created'                      => $item->user_created ?? "There isn't any",
            ]));
        }


        // test Pre Cleaning Stock
        $itemObject = (object)$item;
        $existingItem = PreCleaningStock::where('nomor_job', $itemObject->nomor_job)
            ->where('status',1)
            ->first();

        $dataToUpdate = [
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
            'user_updated'  => $itemObject->user_created ?? "Tes",
        ];

        if ($existingItem) {
            $tambahBeratKeluar = $existingItem->berat_keluar + $itemObject->berat_kirim;
            $tambahPcsKeluar = $existingItem->pcs_keluar + $itemObject->pcs_kirim;
            $sisaBerat = $existingItem->berat_masuk - $tambahBeratKeluar;
            $sisaPcs = $existingItem->pcs_masuk - $tambahPcsKeluar;
            $totalModalBaru = $sisaBerat * $itemObject->modal;
            $dataToUpdate['status'] = 0;
            $dataToUpdate['berat_keluar'] = $tambahBeratKeluar;
            $dataToUpdate['pcs_keluar'] = $tambahPcsKeluar;
            $dataToUpdate['sisa_berat'] = $sisaBerat;
            $dataToUpdate['sisa_pcs'] = $sisaPcs;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } 


        $itemObject = (object) $item;
        $existingItem = PreCleaningInput::where('nomor_job', $itemObject->nomor_job)
            ->where('id_box_raw_material', $itemObject->id_box_raw_material)
            ->first();

        $dataToUpdate = [
            'status'                => $itemObject->status ?? 0,
        ];

        if ($existingItem) {
            // Perbarui data
            $existingItem->update($dataToUpdate);
        }
    }


    public function hapusData($dataArray)
    {
        try {
            DB::beginTransaction();

            foreach ($dataArray as $item) {
                $this->deleteItem($item);
            }

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

    private function deleteItem($item)
    {
        // Hapus data dari PreCleaningOutput
        PreCleaningOutput::where('nomor_job', $item->nomor_job)
            ->where('id_box_grading_kasar', $item->id_box_grading_kasar)
            ->delete();

        // Hitung ulang PreCleaningStock
        $preCleaningStockItems = PreCleaningStock::where('nomor_job', $item->nomor_job)
            ->where('id_box_grading_kasar', $item->id_box_grading_kasar)
            ->get();

        foreach ($preCleaningStockItems as $preCleaningStockItem) {
            $totalBeratKeluar = PreCleaningOutput::where('nomor_job', $item->nomor_job)
                ->where('id_box_grading_kasar', $item->id_box_grading_kasar)
                ->sum('berat_kirim');

            $totalPcsKeluar = PreCleaningOutput::where('nomor_job', $item->nomor_job)
                ->where('id_box_grading_kasar', $item->id_box_grading_kasar)
                ->sum('pcs_grading');

            $sisaBerat = $preCleaningStockItem->berat_masuk - $totalBeratKeluar;
            $sisaPcs = $preCleaningStockItem->pcs_masuk - $totalPcsKeluar;

            $preCleaningStockItem->update([
                'berat_keluar' => $totalBeratKeluar,
                'pcs_keluar' => $totalPcsKeluar,
                'sisa_berat' => $sisaBerat,
                'sisa_pcs' => $sisaPcs,
            ]);
        }

        // Hapus data dari TransitPreCleaningStock
        TransitPreCleaningStock::where('nomor_job', $item->nomor_job)
            ->where('nomor_bstb', $item->nomor_bstb)
            ->delete();
    }
}
