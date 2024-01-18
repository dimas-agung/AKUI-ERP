<?php

namespace App\Services;

use App\Models\GradingKasarHasil;
use App\Models\GradingKasarStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradingKasarHasilService
{
    public function simpanData($dataArray)
    {
        try {
            DB::beginTransaction();
            $ids = [];
            foreach ($dataArray as $item) {
                $ids[] = $this->createItem($item);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $ids,
                'redirectTo' => route('grading_kasar_hasil.index'), // Ganti dengan nama route yang sesuai
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        } finally {
            // stok
            $itemObject = (object)$item;
            // Cari item berdasarkan id_box dan nomor_batch
            $existingItem = GradingKasarStock::where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
                ->where('nomor_batch', $itemObject->nomor_batch)
                ->first();
            // return $existingItem

            $dataToUpdate = [
                // 'doc_no'                            => $itemObject->doc_no,
                'id_box_grading_kasar'              => $itemObject->id_box_grading_kasar,
                'nomor_batch'                       => $itemObject->nomor_batch,
                'nama_supplier'                     => $itemObject->nama_supplier,
                'nomor_nota_internal'               => $itemObject->nomor_nota_internal,
                'jenis_raw_material'                => $itemObject->jenis_raw_material,
                'jenis_grading'                     => $itemObject->jenis_grading[0],
                'id_box_raw_material'               => $itemObject->id_box_raw_material,
                'berat_masuk'                       => $itemObject->berat,
                'berat_keluar'                      => $itemObject->berat_keluar ?? 0,
                'pcs_masuk'                         => $itemObject->pcs_grading,
                'pcs_keluar'                        => $itemObject->pcs_keluar ?? 0,
                'avg_kadar_air'                     => $itemObject->kadar_air,
                'nomor_grading'                     => $itemObject->nomor_grading,
                'modal'                             => $itemObject->modal,
                'total_modal'                       => $itemObject->total_modal,
                'keterangan'                        => $itemObject->keterangan,
                'user_created'                      => $itemObject->user_created ?? 'Admin',
                'user_updated'                      => $itemObject->user_updated ?? 'Admin'
                // Sesuaikan dengan kolom-kolom lain di tabel item Anda
            ];
            GradingKasarStock::create($dataToUpdate);
    }}

    private function createItem($item)
    {
        // stok
        $itemObject = (object)$item;

        $dataToUpdate = [
            // 'doc_no'                            => $itemObject->doc_no,
            'nomor_grading'                     => $itemObject->nomor_grading,
            'id_box_raw_material'               => $itemObject->id_box_raw_material,
            'id_box_grading_kasar'              => $itemObject->id_box_grading_kasar,
            'nomor_batch'                       => $itemObject->nomor_batch,
            'nama_supplier'                     => $itemObject->nama_supplier,
            'nomor_nota_internal'               => $itemObject->nomor_nota_internal,
            'jenis_raw_material'                => $itemObject->jenis_raw_material,
            'berat'                             => $itemObject->berat,
            'kadar_air'                         => $itemObject->kadar_air,
            'jenis_grading'                     => $itemObject->jenis_grading[0],
            'berat_grading'                     => $itemObject->berat_grading,
            'pcs_grading'                       => $itemObject->pcs_grading,
            'susut'                             => $itemObject->susut,
            'modal'                             => $itemObject->modal,
            'total_modal'                       => $itemObject->total_modal,
            'biaya_produksi'                    => $itemObject->biaya_produksi,
            'harga_estimasi'                    => $itemObject->harga_estimasi,
            'total_harga'                       => $itemObject->total_harga,
            'nilai_laba_rugi'                   => $itemObject->nilai_laba_rugi,
            'nilai_prosentase_total_keuntungan' => $itemObject->nilai_prosentase_total_keuntungan,
            'nilai_dikurangi_keuntungan'        => $itemObject->nilai_dikurangi_keuntungan,
            'prosentase_harga_gramasi'          => $itemObject->prosentase_harga_gramasi,
            'selisih_laba_rugi_kg'              => $itemObject->selisih_laba_rugi_kg,
            'selisih_laba_rugi_gram'            => $itemObject->selisih_laba_rugi_gram,
            'hpp'                               => $itemObject->hpp,
            'total_hpp'                         => $itemObject->total_hpp,
            'keterangan'                        => $itemObject->keterangan,
            'user_created'                      => $item->user_created ?? 'Admin',
            'user_updated'                      => $item->user_updated ?? 'Admin',
        ];
        $GradingKasarHasil = GradingKasarHasil::create($dataToUpdate);
        return $GradingKasarHasil->id;
    }
}
