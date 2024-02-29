<?php
namespace App\Services;

use App\Models\GradingKasarHasil;
use App\Models\GradingKasarOutput;
use App\Models\GradingKasarStock;
use App\Models\StockTransitGradingKasar;
use App\Models\StockTransitRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradingKasarOutputService
{
    public function sendData($dataArray)
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
                'redirectTo' => route('GradingKasarOutput.index'), // Ganti dengan nama route yang sesuai
                // 'redirectTo' => null,
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
        GradingKasarOutput::create([
            'nomor_bstb'            => $item->nomor_bstb,
            'id_box_grading_kasar'  => $item->id_box_grading_kasar,
            'nomor_batch'           => $item->nomor_batch,
            'nomor_job'             => $item->nomor_job,
            'nama_supplier'         => $item->nama_supplier,
            'id_box_raw_material'   => $item->id_box_raw_material,
            'jenis_raw_material'    => $item->jenis_raw_material,
            'jenis_grading'         => $item->jenis_grading,
            'berat_keluar'          => $item->berat_keluar,
            'pcs_keluar'            => $item->pcs_keluar,
            'avg_kadar_air'         => $item->avg_kadar_air,
            'tujuan_kirim'      => $item->tujuan_kirim,
            'nomor_grading'     => $item->nomor_grading,
            'biaya_produksi'    => $item->biaya_produksi ?? 0,
            'modal'             => $item->modal,
            'total_modal'       => $item->total_modal,
            'fix_total_modal'   => $item->fix_total_modal,
            'keterangan'        => $item->keterangan,
            'user_created'      => $item->user_created,
            'user_updated'      => $item->user_updated ?? " ",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        // Creat Prm Raw Material Stock
        $itemObject = (object)$item;
        $existingItem = StockTransitGradingKasar::where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
            ->where('nomor_bstb', $itemObject->nomor_bstb)
            ->first();
            // return $existingItem

        $dataToUpdate = [
            'berat_keluar'  => $itemObject->berat_keluar,
            'pcs_keluar'    => $itemObject->pcs_keluar,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            // $lastBeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;
            $lastPcsKeluar = $existingItem->pcs_keluar;

            $tambahBeratKeluar = $lastBeratKeluar + $itemObject->berat_keluar;
            $perbedaanBerat = $lastPcsKeluar + $itemObject->pcs_keluar;
            $totalModalBaru = $tambahBeratKeluar * $itemObject->modal;

            $dataToUpdate['berat_keluar'] = $tambahBeratKeluar;
            $dataToUpdate['pcs_keluar'] = $perbedaanBerat;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru dalam database
            StockTransitGradingKasar::create(array_merge($dataToUpdate, [
            'nomor_job'              => $itemObject->nomor_job,
            'id_box_grading_kasar'              => $itemObject->id_box_grading_kasar,
            'nomor_bstb'                       => $itemObject->nomor_bstb,
            'nomor_batch'                       => $itemObject->nomor_batch,
            'nama_supplier'                     => $itemObject->nama_supplier,
            'nomor_nota_internal'               => $itemObject->nomor_nota_internal,
            'jenis_raw_material'                => $itemObject->jenis_raw_material,
            'jenis_grading'                     => $itemObject->jenis_grading,
            'id_box_raw_material'               => $itemObject->id_box_raw_material,
            'avg_kadar_air'                     => $itemObject->avg_kadar_air,
            'tujuan_kirim'                     => $itemObject->tujuan_kirim,
            'nomor_grading'                     => $itemObject->nomor_grading,
            'biaya_produksi'                    => $itemObject->biaya_produksi  ?? 0,
            'modal'                             => $itemObject->modal,
            'fix_total_modal'                   => $itemObject->fix_total_modal,
            'user_created'                      => $itemObject->user_created ?? 'Admin',
            'user_updated'                      => $itemObject->user_updated ?? " ",
            ]));
        }


        // Creat Prm Raw Material Stock
        $itemObject = (object)$item;
        $existingItem = GradingKasarStock::where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
            ->where('id_box_raw_material', $itemObject->id_box_raw_material)
            ->first();
            // return $existingItem

        $dataToUpdate = [
            'berat_keluar'  => $itemObject->berat_keluar,
            'pcs_keluar'    => $itemObject->pcs_keluar,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan,
            'user_updated'  => $itemObject->user_created ?? " ",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            // $lastBeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;
            $lastPcsKeluar = $existingItem->pcs_keluar;

            $tambahBeratKeluar = $lastBeratKeluar + $itemObject->berat_keluar;
            $perbedaanBerat = $lastPcsKeluar + $itemObject->pcs_keluar;
            $totalModalBaru = $tambahBeratKeluar * $itemObject->modal;

            $dataToUpdate['berat_keluar'] = $tambahBeratKeluar;
            $dataToUpdate['pcs_keluar'] = $perbedaanBerat;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru dalam database
            GradingKasarStock::create(array_merge($dataToUpdate, [
            'id_box_grading_kasar'              => $itemObject->id_box_grading_kasar,
            'nomor_batch'                       => $itemObject->nomor_batch,
            'nama_supplier'                     => $itemObject->nama_supplier,
            'nomor_nota_internal'               => $itemObject->nomor_nota_internal,
            'jenis_raw_material'                => $itemObject->jenis_raw_material,
            'jenis_grading'                     => $itemObject->jenis_grading[0],
            'id_box_raw_material'               => $itemObject->id_box_raw_material,
            'berat_masuk'                       => $itemObject->berat_grading ?? 0,
            'pcs_masuk'                         => $itemObject->pcs_grading  ?? 0,
            'avg_kadar_air'                     => $itemObject->kadar_air,
            'nomor_grading'                     => $itemObject->nomor_grading,
            'modal'                             => $itemObject->modal,
            'total_modal'                       => $itemObject->total_modal,
            'keterangan'                        => $itemObject->keterangan,
            'user_created'                      => $itemObject->user_created ?? 'Admin',
            ]));
        }


        $itemObject = (object) $item;
        $existingItem = GradingKasarHasil::where('nama_supplier', $itemObject->nama_supplier)
            ->where('nomor_batch', $itemObject->nomor_batch)
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
