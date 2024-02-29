<?php

namespace App\Services;

use App\Models\GradingKasarHasil;
use App\Models\GradingKasarStock;
use App\Services\HppService;
use App\Models\MasterJenisGradingKasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Finally_;

class GradingKasarHasilService
{
    public function simpanData($dataArray, $total_susut)
    {
        try {
            DB::beginTransaction();
            $ids = [];
            foreach ($dataArray as $item) {
                $ids[] = $this->createItem($item, $total_susut);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $ids,
                'redirectTo' => route('GradingKasarHasil.index'), // Ganti dengan nama route yang sesuai
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }
    }


    private function createItem($item, $total_susut)
    {
        // stok
        $itemObject = (object)$item;
        // Cari item berdasarkan id_box dan nomor_batch
        // $existingItem = GradingKasarStock::where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
        //     ->where('nomor_batch', $itemObject->nomor_batch)
        //     ->first();
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
            'berat_masuk'                       => $itemObject->berat_grading,
            'berat_keluar'                      => $itemObject->berat_keluar ?? 0,
            'pcs_masuk'                         => $itemObject->pcs_grading,
            'pcs_keluar'                        => $itemObject->pcs_keluar ?? 0,
            'avg_kadar_air'                     => $itemObject->kadar_air,
            'nomor_grading'                     => $itemObject->nomor_grading,
            'modal'                             => $item->modal,
            'total_modal'                       => $itemObject->total_modal,
            'keterangan'                        => $itemObject->keterangan,
            'user_created'                      => $itemObject->user_created ?? 'Admin',
            'user_updated'                      => $itemObject->user_updated ?? 'Admin'
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];
        GradingKasarStock::create($dataToUpdate);
        // $dataToUpdate = GradingKasarStock::create($dataToUpdate);
        // if ($existingItem) {
        //     // Ambil nilai terakhir berat_masuk dan berat_keluar
        //     // $BeratMasuk = $existingItem->berat_masuk;
        //     // $lastBeratKeluar = $existingItem->berat_keluar;

        //     // // Update nilai berat_masuk pada item yang sudah ada
        //     // $lastBeratMasuk = $existingItem->berat_masuk += $itemObject->berat_bersih;
        //     // $existingItem->berat_keluar = $itemObject->berat_keluar ?? $existingItem->berat_keluar ?? 0;

        //     // Tentukan nilai sisa_berat sesuai kondisi
        //     // if ($existingItem->berat_keluar === 0 || $existingItem->berat_keluar === null) {
        //     //     // Jika berat_keluar belum diisi, isi sisa_berat dengan nilai berat_masuk
        //     //     $existingItem->sisa_berat = (int)$BeratMasuk;
        //     // } else {
        //     //     // Jika berat_keluar sudah diisi, hitung sisa berat
        //     //     $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
        //     // }

        //     // Update juga kolom-kolom lain yang diperlukan
        //     $existingItem->nomor_nota_internal = $itemObject->nomor_nota_internal;
        //     $existingItem->avg_kadar_air = $itemObject->kadar_air;
        //     $existingItem->keterangan = $itemObject->keterangan;
        //     // $existingItem->user_created = $itemObject->user_created;
        //     // $existingItem->user_updated = $itemObject->user_updated;

        //     // // Simpan perubahan pada stok yang sudah ada
        //     $existingItem->save();
        // } else {
        //     // Jika item tidak ada, buat item baru dalam database
        // GradingKasarStock::create($dataToUpdate);
        // }
        $GradingKasarHasil = GradingKasarHasil::create([
            // 'doc_no'            => $item->doc_no,
            'nomor_grading'                     => $item->nomor_grading,
            'id_box_raw_material'               => $item->id_box_raw_material,
            'id_box_grading_kasar'              => $item->id_box_grading_kasar,
            'nomor_batch'                       => $item->nomor_batch,
            'nama_supplier'                     => $item->nama_supplier,
            'nomor_nota_internal'               => $item->nomor_nota_internal,
            'jenis_raw_material'                => $item->jenis_raw_material,
            'berat'                             => $item->berat,
            'kadar_air'                         => $item->kadar_air,
            'jenis_grading'                     => $item->jenis_grading[0],
            'berat_grading'                     => $item->berat_grading,
            'pcs_grading'                       => $item->pcs_grading,
            'susut'                             => $total_susut,
            'modal'                             => $item->modal,
            'total_modal'                       => $item->total_modal,
            'biaya_produksi'                    => $item->biaya_produksi,
            'harga_estimasi'                    => $item->harga_estimasi,
            'total_harga'                       => $item->total_harga,
            'nilai_laba_rugi'                   => $item->nilai_laba_rugi,
            'nilai_prosentase_total_keuntungan' => $item->nilai_prosentase_total_keuntungan,
            'nilai_dikurangi_keuntungan'        => $item->nilai_dikurangi_keuntungan,
            'prosentase_harga_gramasi'          => $item->prosentase_harga_gramasi,
            'selisih_laba_rugi_kg'              => $item->selisih_laba_rugi_kg,
            'selisih_laba_rugi_gram'            => $item->selisih_laba_rugi_gram,
            'hpp'                               => $item->hpp,
            'total_hpp'                         => $item->total_hpp,
            'keterangan'                        => $item->keterangan,
            'user_created'                      => $item->user_created ?? 'Admin',
            'user_updated'                      => $item->user_updated ?? 'Admin',
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
        return $GradingKasarHasil->id;
    }
}
