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

            foreach ($dataArray as $item) {
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
            'tujuan_kirim'                      => $item->tujuan_kirim,
            'modal'                             => $item->modal,
            'total_modal'                       => $item->total_modal,
            'operator_sikat_n_kompresor'        => $item->operator_sikat_n_kompresor,
            'operator_flek_n_poles'             => $item->operator_flek_n_poles,
            'operator_cutter'                   => $item->operator_cutter,
            'kuningan'                          => $item->kuningan,
            'sterofoam'                         => $item->sterofoam,
            'karat'                             => $item->karat,
            'rontokan_flek'                     => $item->rontokan_flek,
            'rontokan_bahan'                    => $item->rontokan_bahan,
            'rontokan_serabut'                  => $item->rontokan_serabut,
            'ws_0_0_0'                          => $item->ws_0_0_0,
            'berat_pre_cleaning'                => $item->berat_pre_cleaning,
            'pcs_pre_cleaning'                  => $item->pcs_pre_cleaning,
            'susut'                             => $item->susutTabel,
            'keterangan'                        => $item->keterangan,
            'nomor_grading'                     => $item->nomor_grading ?? "UGK_TES",
            'user_created'                      => $item->user_created,
        ]);

        $itemObject = (object)$item;
        $existingItem = TransitPreCleaningStock::where('nomor_job', $itemObject->nomor_job)
            ->where('nomor_bstb', $itemObject->nomor_bstb)
            ->first();

        $dataToUpdate = [
            'berat_kirim'   => $itemObject->berat_kirim,
            'pcs_kirim'     => $itemObject->pcs_kirim,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
        ];

        if ($existingItem) {
            $sisaBeratBaru = $existingItem->sisa_berat + $itemObject->berat_kirim;
            $totalModalBaru = $existingItem->berat_kirim * $itemObject->modal;

            $dataToUpdate['berat_kirim'] = $existingItem->berat_kirim + $itemObject->berat_kirim;
            $dataToUpdate['pcs_kirim'] = $existingItem->pcs_kirim + $itemObject->pcs_kirim;
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
                'tujuan_kirim'                      => $item->tujuan_kirim,
                'modal'                             => $item->modal,
                'total_modal'                       => $item->total_modal,
                'sisa_berat'                        => $item->berat_kirim, // Jika baru, maka sisa_berat sama dengan berat_kirim
                'keterangan'                        => $item->keterangan,
                'nomor_grading'                     => $item->nomor_grading ?? "UGK_TES",
                'user_created'                      => $item->user_created ?? "There isn't any",
            ]));
        }


        // test Pre Cleaning Stock
        $itemObject = (object)$item;
        $existingItem = PreCleaningStock::where('nomor_job', $itemObject->nomor_job)
            ->where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
            ->first();

        $dataToUpdate = [
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
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
            PreCleaningStock::create(array_merge($dataToUpdate, [
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
                'keterangan'                        => $item->keterangan,
                'nomor_grading'                     => $item->nomor_grading ?? "UGK_TES",
                'user_created'                      => $item->user_created ?? "There isn't any",
                // 'user_updated'                      => $item->user_updated ?? "There isn't any",
            ]));
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
                ->sum('pcs_kirim');

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
