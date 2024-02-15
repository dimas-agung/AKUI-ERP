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
                'redirectTo' => route('PrmRawMaterialInput.index'), // Ganti dengan nama route yang sesuai
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
            // 'doc_no'                         => $dataArray[0]->doc_no,
            'nomor_job'                         => $item->nomor_job,
            'id_box_grading_kasar'              => $item->id_box_grading_kasar,
            'nomor_bstb'                        => $item->nomor_bstb,
            'id_box_raw_material'               => $item->id_box_raw_material,
            'nomor_batch'                       => $item->nomor_batch,
            'nomor_nota_internal'               => $item->nomor_nota_internal,
            'nama_supplier'                     => $item->nama_supplier,
            'jenis_raw_material'                => $item->jenis_raw_material,
            'jenis_kirim'                       => $item->jenis_kirim,
            'tujuan_kirim'                      => $item->tujuan_kirim,
            'modal'                             => $item->modal,
            'total_modal'                       => $item->total_modal,
            'kadar_air'                         => $item->kadar_air,
            'pcs_kirim'                         => $item->pcs_kirim,
            'berat_kirim'                       => $item->berat_kirim,
            'operator_sikat_kompresor'          => $item->operator_sikat_kompresor,
            'operator_flek_poles'               => $item->operator_flek_poles,
            'operator_flek_cutter'              => $item->operator_flek_cutter,
            'kuningan'                          => $item->kuningan,
            'sterofoam'                         => $item->sterofoam,
            'karat'                             => $item->karat,
            'rontokan_fisik'                    => $item->rontokan_fisik,
            'rontokan_bahan'                    => $item->rontokan_bahan,
            'rontokan_serabut'                  => $item->rontokan_serabut,
            'ws_0_0_0'                          => $item->ws_0_0_0,
            'berat_pre_cleaning'                => $item->berat_pre_cleaning,
            'pcs_pre_cleaning'                  => $item->pcs_pre_cleaning,
            'susut'                             => $item->susutTabel,
            'user_created'                      => $item->user_created ?? 'Admin123',
            'user_updated'                      => $item->user_updated ?? 'Admin123',
        ]);

        // Creat Transit Pre Cleaning Stock
        $itemObject = (object)$item;
        $existingItem = TransitPreCleaningStock::where('nomor_job', $itemObject->nomor_job)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'berat_kirim'               => $itemObject->berat_kirim,
            'pcs_kirim'                 => $itemObject->pcs_kirim,
            'modal'                     => $itemObject->modal,
            'total_modal'               => $itemObject->total_modal,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            $lastBeratMasuk = $existingItem->berat_kirim;
            // $lastBeratKeluar = $existingItem->berat_keluar;
            $lastPcsKirim = $existingItem->pcs_kirim;

            $tambahBeratMasuk = $lastBeratMasuk + $itemObject->berat_kirim;
            $perbedaanBerat = $lastPcsKirim + $itemObject->pcs_kirim;
            $totalModalBaru = $tambahBeratMasuk * $itemObject->modal;

            $dataToUpdate['berat_kirim'] = $tambahBeratMasuk;
            $dataToUpdate['pcs_kirim'] = $perbedaanBerat;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            TransitPreCleaningStock::create(array_merge($dataToUpdate, [
                'nomor_job'                 => $itemObject->nomor_job,
                'id_box_grading_kasar'      => $itemObject->id_box_grading_kasar,
                'nomor_bstb'                => $itemObject->nomor_bstb,
                'nama_supplier'             => $itemObject->nama_supplier,
                'nomor_nota_internal'       => $itemObject->nomor_nota_internal,
                'nomor_batch'               => $itemObject->nomor_batch,
                'id_box_raw_material'       => $itemObject->id_box_raw_material,
                'jenis_raw_material'        => $itemObject->jenis_raw_material,
                'jenis_kirim'               => $itemObject->jenis_kirim,
                // 'berat_kirim'               => $itemObject->berat_kirim,
                // 'pcs_kirim'                 => $itemObject->pcs_kirim,
                'kadar_air'                 => $itemObject->kadar_air,
                'tujuan_kirim'              => $itemObject->tujuan_kirim,
                'nomor_grading'             => $itemObject->nomor_grading ?? "Belum Tersedia",
                'modal'                     => $itemObject->modal,
                // 'total_modal'               => $itemObject->total_modal,
                'keterangan'                => $itemObject->keterangan ?? "Tes",
                'user_created'              => $itemObject->user_created ?? "There isn't any",
                'user_updated'              => $itemObject->user_updated ?? "There isn't any",
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
}
