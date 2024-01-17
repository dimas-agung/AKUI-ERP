<?php

namespace App\Services;

use App\Models\GradingKasarHasil;
use App\Models\MasterJenisGradingKasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradingKasarHasilService
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
                'redirectTo' => route('grading_kasar_hasil.index'), // Ganti dengan nama route yang sesuai
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
        // stok
        $itemObject = (object)$item;
        // Cari item berdasarkan id_box dan nomor_batch
        // $existingItem = GradingKasarHasil::where('nomor_grading', $itemObject->nomor_grading)
        //     ->where('nomor_batch', $itemObject->nomor_batch)
        //     ->first();
        // return $existingItem

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
            // 'harga_estimasi'                    => $itemObject->harga_estimasi,
            'harga_estimasi'                    => $itemObject->harga_estimasi ?? 0,
            'total_harga'                       => $itemObject->total_harga ?? 0,
            // 'total_harga'                       => $itemObject->harga_estimasi * $itemObject->berat_grading,
            'nilai_laba_rugi'                   => $itemObject->nilai_laba_rugi ?? 0,
            'nilai_prosentase_total_keuntungan' => $itemObject->nilai_prosentase_total_keuntungan ?? 0,
            'nilai_dikurangi_keuntungan'        => $itemObject->nilai_dikurangi_keuntungan ?? 0,
            'prosentase_harga_gramasi'          => $itemObject->prosentase_harga_gramasi ?? 0,
            'selisih_laba_rugi_kg'              => $itemObject->selisih_laba_rugi_kg ?? 0,
            'selisih_laba_rugi_gram'            => $itemObject->selisih_laba_rugi_gram ?? 0,
            'hpp'                               => $itemObject->hpp ?? 0,
            'total_hpp'                         => $itemObject->total_hpp ?? 0,
            'keterangan'                        => $itemObject->keterangan,
            'user_created'                      => $item->user_created ?? 'Admin',
            'user_updated'                      => $item->user_updated ?? 'Admin',
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];
        GradingKasarHasil::create($dataToUpdate);

        // if ($existingItem) {

        // Update juga kolom-kolom lain yang diperlukan
        // $existingItem->nomor_grading = $itemObject->nomor_grading;
        // $existingItem->id_box_raw_material = $itemObject->id_box_raw_material;
        // $existingItem->id_box_grading_kasar = $itemObject->id_box_grading_kasar;
        // $existingItem->nomor_batch = $itemObject->nomor_batch;
        // $existingItem->nama_supplier = $itemObject->nama_supplier;
        // $existingItem->nomor_nota_internal = $itemObject->nomor_nota_internal;
        // $existingItem->jenis_raw_material = $itemObject->jenis_raw_material;
        // $existingItem->berat = $itemObject->berat;
        // $existingItem->kadar_air = $itemObject->kadar_air;
        // $existingItem->jenis_grading = $itemObject->jenis_grading;
        // $existingItem->berat_grading = $itemObject->berat_grading;
        // $existingItem->pcs_grading = $itemObject->pcs_grading;
        // $existingItem->susut = $itemObject->susut;
        // $existingItem->modal = $itemObject->modal;
        // $existingItem->total_modal = $itemObject->total_modal;
        // $existingItem->biaya_produksi = $itemObject->biaya_produksi;
        // $existingItem->harga_estimasi = $itemObject->harga_estimasi;
        // $existingItem->total_harga = $itemObject->total_harga;
        // $existingItem->nilai_laba_rugi = $itemObject->nilai_laba_rugi;
        // $existingItem->nilai_prosentase_total_keuntungan = $itemObject->nilai_prosentase_total_keuntungan;
        // $existingItem->nilai_dikurangi_keuntungan = $itemObject->nilai_dikurangi_keuntungan;
        // $existingItem->prosentase_harga_gramasi = $itemObject->prosentase_harga_gramasi;
        // $existingItem->selisih_laba_rugi_kg = $itemObject->selisih_laba_rugi_kg;
        // $existingItem->selisih_laba_rugi_gram = $itemObject->selisih_laba_rugi_gram;
        // $existingItem->hpp = $itemObject->hpp;
        // $existingItem->total_hpp = $itemObject->total_hpp;
        // $existingItem->keterangan = $itemObject->keterangan;
        // $existingItem->user_created = $itemObject->user_created;

        // Simpan perubahan pada stok yang sudah ada
        //     $existingItem->save();
        // } else {
        //     // Jika item tidak ada, buat item baru dalam database
        //     GradingKasarHasil::create($dataToUpdate);
        // }
    }
}
