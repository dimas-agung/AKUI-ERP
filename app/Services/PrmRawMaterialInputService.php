<?php

namespace App\Services;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialInputService
{
    public function simpanData($dataHeader, $dataArray)
    {
        try {
            DB::beginTransaction();

            $this->createHeader($dataHeader);
            // foreach ($dataHeader as $header) {
            //     $this->createHeader($header);
            // }

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

    private function createHeader($header)
    {
        // stok
        $itemObject = (object)$header;
        // Cari item berdasarkan id_box dan nomor_batch
        $existingItem = PrmRawMaterialInput::where('nomor_nota_internal', $itemObject->nomor_nota_internal)
            ->where('created_at')
            ->first();
        // return $existingItem

        $dataToUpdate = [
            // 'doc_no'                => $dataHeader->doc_no,
            'nomor_po'              => $header->nomor_po,
            'nomor_batch'           => $header->nomor_batch,
            'nomor_nota_supplier'   => $header->nomor_nota_supplier,
            'nomor_nota_internal'   => $header->nomor_nota_internal,
            'nama_supplier'         => $header->nama_supplier,
            'keterangan'            => $header->keterangan,
            'user_created'          => $header->user_created,
            'user_updated'          => $header->user_updated ?? ''
            // Sesuaikan dengan kolom-kolom lain di tabel header Anda
        ];
        //
        if ($existingItem) {
            // Simpan perubahan pada stok yang sudah ada
            $existingItem->save();
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PrmRawMaterialInput::create($dataToUpdate);
        }
    }

    private function createItem($item)
    {
        $defaultBeratKeluar = 0;
        // $defaultIdBox = '';
        // Creat Prm Raw Material Stock History
        PrmRawMaterialStockHistory::create([
            'id_box'        => $item->id_box,
            // 'doc_no'        => $defaultIdBox,
            // 'doc_no'        => $item->nomor_nota_internal,
            'berat_masuk'   => $item->berat_bersih,
            'berat_keluar'  => $defaultBeratKeluar,
            'sisa_berat'    => $item->berat_bersih,
            'avg_kadar_air' => $item->kadar_air,
            'modal'         => $item->fix_harga_deal,
            'total_modal'   => $item->total_harga_nota,
            // 'fix_harga_deal' => $item->fixHargaDealForRow,
            'fix_harga_deal' => $item->fix_harga_deal,
            'keterangan'    => $item->keterangan,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated ?? '',
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
        // Input Item
        PrmRawMaterialInputItem::create([
            'jenis'             => $item->jenis,
            'id_box'            => $item->id_box,
            'berat_nota'        => $item->berat_nota,
            'berat_kotor'       => $item->berat_kotor,
            'berat_bersih'      => $item->berat_bersih,
            'selisih_berat'     => $item->selisih_berat,
            'kadar_air'         => $item->kadar_air,
            'harga_nota'        => $item->harga_nota,
            'total_harga_nota'  => $item->total_harga_nota,
            'harga_deal'        => $item->harga_deal,
            'fix_harga_deal'    => $item->fix_harga_deal,
            // 'fix_harga_deal'    => $inputItem->fixHargaDealForRow,
            'keterangan'        => $item->keterangan,
            'user_created'      => $item->user_created,
            'user_updated'      => $item->user_updated ?? '',
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        // Calculate average kadar air and update prmstock
        $totalKadarAir = PrmRawMaterialStockHistory::where('id_box', $item->id_box)->sum('avg_kadar_air');
        $jumlahBaris = PrmRawMaterialStockHistory::where('id_box', $item->id_box)->count();
        $averageKadarAir = $jumlahBaris > 0 ? $totalKadarAir / $jumlahBaris : 0;

        $prmStock = PrmRawMaterialStock::where('id_box', $item->id_box)->first();
        if ($prmStock) {
            // Pastikan nilai avg_kadar_air di-format sebagai desimal sebelum disimpan
            $prmStock->avg_kadar_air = number_format($averageKadarAir, 2); // Format dengan 2 digit desimal
            $prmStock->save();
        }

        // stok
        $itemObject = (object)$item;
        // Cari item berdasarkan id_box dan nomor_batch
        $existingItem = PrmRawMaterialStock::where('id_box', $itemObject->id_box)
            ->where('nomor_batch', $itemObject->nomor_batch)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'id_box'                => $itemObject->id_box,
            'nomor_nota_internal'   => $itemObject->nomor_nota_internal,
            'nomor_batch'           => $itemObject->nomor_batch,
            'nama_supplier'         => $itemObject->nama_supplier,
            'jenis'                 => $itemObject->jenis,
            'berat_masuk'           => $itemObject->berat_bersih,
            'berat_keluar'          => $itemObject->berat_keluar ?? 0,
            'sisa_berat'            => $itemObject->berat_bersih,
            'avg_kadar_air'         => $itemObject->avg_kadar_air,
            'modal'                 => $itemObject->fix_harga_deal,
            'total_modal'           => $itemObject->fix_harga_deal * $itemObject->berat_bersih,
            'keterangan'            => $itemObject->keterangan,
            'user_created'          => $itemObject->user_created,
            'user_updated'          => $itemObject->user_updated ?? '',
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];
        //
        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            $BeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;

            // Update nilai berat_masuk pada item yang sudah ada
            $lastBeratMasuk = $existingItem->berat_masuk += $itemObject->berat_bersih;
            $existingItem->berat_keluar = $itemObject->berat_keluar ?? $existingItem->berat_keluar ?? 0;

            // Tentukan nilai sisa_berat sesuai kondisi
            if ($existingItem->berat_keluar === 0 || $existingItem->berat_keluar === null) {
                // Jika berat_keluar belum diisi, isi sisa_berat dengan nilai berat_masuk
                $existingItem->sisa_berat = (int)$BeratMasuk;
            } else {
                // Jika berat_keluar sudah diisi, hitung sisa berat
                $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
            }

            if ($existingItem->total_modal === 0 || $existingItem->total_modal === null) {
                // tet
                $existingItem->total_modal = $existingItem->modal * $existingItem->sisa_berat;
            } else {
                $existingItem->total_modal = $existingItem->modal * $existingItem->sisa_berat;
            }

            // Update juga kolom-kolom lain yang diperlukan
            $existingItem->nomor_nota_internal = $itemObject->nomor_nota_internal;
            // $existingItem->avg_kadar_air = $itemObject->avg_kadar_air;
            $existingItem->keterangan = $itemObject->keterangan;
            $existingItem->user_created = $itemObject->user_created ?? '';

            // Simpan perubahan pada stok yang sudah ada
            $existingItem->save();
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PrmRawMaterialStock::create($dataToUpdate);
        }
    }
}
