<?php

namespace App\Services;

use App\Models\PrmRawMaterialOutputItem;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialOutputService
{
    public function sendData($dataArray)
    {
        try {
            DB::beginTransaction();

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }

            // foreach ($dataStock as $item) {
            //     $this->createStock($item);
            // }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('PrmRawMaterialOutput.index'), // Ganti dengan nama route yang sesuai
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
        PrmRawMaterialOutputItem::create([
            'doc_no'        => $item->doc_no,
            'nomor_bstb'    => $item->nomor_bstb,
            'nomor_batch'   => $item->nomor_batch,
            'id_box'        => $item->id_box,
            'nama_supplier' => $item->nama_supplier,
            'jenis'         => $item->jenis,
            'berat'         => $item->berat,
            'kadar_air'     => $item->kadar_air,
            'tujuan_kirim'  => $item->tujuan_kirim,
            'letak_tujuan'  => $item->letak_tujuan,
            'inisial_tujuan' => $item->inisial_tujuan,
            'modal'         => $item->modal,
            'total_modal'   => $item->total_modal,
            'keterangan_item' => $item->keterangan_item,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        PrmRawMaterialStockHistory::create([
            'id_box'        => $item->id_box,
            'doc_no'        => $item->doc_no,
            'berat_masuk'   => $item->berat_masu ?? 0,
            'berat_keluar'  => $item->berat,
            'sisa_berat'    => $item->selisih_berat,
            'avg_kadar_air' => $item->kadar_air,
            'modal'         => $item->modal,
            'total_modal'   => $item->total_modal,
            'keterangan'    => $item->keterangan_item,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        // Creat Stock Transit Grading Kasar
        $itemObject = (object)$item;
        $existingItem = StockTransitGradingKasar::where('nama_supplier', $itemObject->nama_supplier)
            ->where('nomor_bstb', $itemObject->nomor_bstb)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'id_box'        => $itemObject->id_box,
            'nomor_bstb'    => $itemObject->nomor_bstb,
            'nomor_batch'   => $item->nomor_batch,
            'nama_supplier' => $itemObject->nama_supplier,
            'jenis'         => $itemObject->jenis,
            'berat'         => $itemObject->berat,
            'kadar_air'     => $itemObject->kadar_air,
            'tujuan_kirim'  => $itemObject->tujuan_kirim,
            'letak_tujuan'  => $itemObject->letak_tujuan,
            'inisial_tujuan' => $itemObject->inisial_tujuan,
            'modal'         => $itemObject->modal,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan_item,
            'user_created'  => $itemObject->user_created,
            'user_updated'  => $itemObject->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Jika item sudah ada, perbarui data
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            StockTransitGradingKasar::create($dataToUpdate);
        }


        // Creat Prm Raw Material Stock
        $itemObject = (object)$item;
        $existingItem = PrmRawMaterialStock::where('id_box', $itemObject->id_box)
            ->where('nomor_batch', $itemObject->nomor_batch)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'id_box'        => $itemObject->id_box,
            'nomor_batch'   => $itemObject->nomor_batch,
            'nama_supplier' => $itemObject->nama_supplier,
            'jenis'         => $itemObject->jenis,
            'berat_masuk'   => $itemObject->berat_masuk,
            'berat_keluar'  => $itemObject->berat,
            'sisa_berat'    => $itemObject->selisih_berat,
            'avg_kadar_air' => $itemObject->kadar_air,
            'modal'         => $itemObject->modal,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan_item,
            'user_created'  => $itemObject->user_created,
            'user_updated'  => $itemObject->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            $lastBeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;

            // Update nilai berat_masuk pada item yang sudah ada
            $lastBeratKeluar = $existingItem->berat_keluar += $itemObject->berat;
            $existingItem->berat_masuk = $itemObject->berat_masuk ?? $existingItem->berat_masuk ?? 0;

            // Tentukan nilai sisa_berat sesuai kondisi
            if ($existingItem->berat_keluar === null || $existingItem->berat_keluar === 0) {
                // Jika berat_keluar belum diisi, isi sisa_berat dengan nilai berat_masuk
                $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
            } else {
                // Jika berat_keluar sudah diisi, hitung sisa berat
                $existingItem->sisa_berat = $lastBeratMasuk - $lastBeratKeluar;
            }

            $existingItem->modal = $itemObject->modal ?? $existingItem->modal ?? 0;
            $existingItem->total_modal = $itemObject->total_modal ?? $existingItem->total_modal ?? 0;
            $existingItem->keterangan = $itemObject->keterangan_item;
            // Simpan perubahan pada stok yang sudah ada
            $existingItem->save();
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PrmRawMaterialStock::create($dataToUpdate);
        }
    }

    public function updateItem($request, $id)
    {
        try {
            DB::beginTransaction();
            // Update item
            $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
            $stockTGK = StockTransitGradingKasar::where('id', $id)->first();
            $PrmRawMS = PrmRawMaterialStock::where('id_box', $request->id_box);
            $PrmRawMOIC->update($request->all());
            $stockTGK->update($request->all());
            $PrmRawMS->update([
                'id_box'        => $request->id_box,
                'nomor_batch'   => $request->nomor_batch,
                'nama_supplier' => $request->nama_supplier,
                'jenis'         => $request->jenis,
                'berat_keluar'  => $request->berat,
                'sisa_berat'    => $request->selisih_berat,
                'avg_kadar_air' => $request->kadar_air,
                'modal'         => $request->modal,
                'total_modal'   => $request->total_modal,
                'keterangan'    => $request->keterangan_item,
                'user_created'  => $request->user_created,
                'user_updated'  => $request->user_updated,
                // Sesuaikan dengan kolom-kolom lain di tabel item Anda
            ]);

            // Creat Prm Raw Material Stock History
            PrmRawMaterialStockHistory::create([
                'id_box'        => $request->id_box,
                'doc_no'        => $request->doc_no,
                'berat_masuk'   => $request->berat_masuk  ?? 0,
                'berat_keluar'  => $request->berat,
                'sisa_berat'    => $request->selisih_berat,
                'avg_kadar_air' => $request->kadar_air,
                'modal'         => $request->modal,
                'total_modal'   => $request->total_modal,
                'keterangan'    => $request->keterangan_item,
                'user_created'  => $request->user_created,
                'user_updated'  => $request->user_updated,
                // Sesuaikan dengan kolom-kolom lain di tabel item Anda
            ]);
            DB::commit();

            return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }
    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'doc_no'       => 'required',
            'nomor_bstb'   => 'required',
            'nomor_batch'  => 'required',
            'id_box'       => 'required',
            'nama_supplier' => 'required',
            'jenis'        => 'required',
            'berat'        => 'required',
            'kadar_air'    => 'required',
            'tujuan_kirim' => 'required',
            'letak_tujuan' => 'required',
            'inisial_tujuan' => 'required',
            'modal'        => 'required',
            'total_modal'  => 'required',
            'keterangan_item'    => '',
            'user_created' => '',
            'user_updated' => ''
        ], [
            'doc_no.required' => 'Kolom Nomer Document Wajib diisi.',
            'nomor_bstb.required' => 'Kolom Nomer BSTB Wajib diisi.'
        ]);
    }
}
