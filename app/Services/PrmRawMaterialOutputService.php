<?php

namespace App\Services;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
use App\Models\StockTransitRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
        // $items = collect($item);
        $existingItem = StockTransitRawMaterial::where('tujuan_kirim', $itemObject->tujuan_kirim)
            ->where('id_box', $itemObject->id_box)
            ->first();

        $jumlahData = PrmRawMaterialOutputItem::distinct('nomor_bstb')->count('id_box');
        $jumlahKadarAir = PrmRawMaterialOutputItem::groupBy('id_box')
                    ->selectRaw('id_box, sum(kadar_air) as total_kadar_air')
                    ->pluck('total_kadar_air');


        $dataToUpdate = [
            'id_box'        => $itemObject->id_box,
            'berat'         => $itemObject->berat,
            'kadar_air'     => $itemObject->kadar_air,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan_item,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Jika item sudah ada, perbarui data
            $beratSebelumnya = $existingItem->berat;
            $avgairSebelumnya = $existingItem->kadar_air;
            $banyakData = $jumlahData;

            // Menghitung rata-rata kadar air baru
            if (isset($jumlahKadarAir[$itemObject->id_box])) {
                $banyakKadarAir = $jumlahKadarAir[$itemObject->id_box];
                $avgKadarAirBaru = $banyakKadarAir / $banyakData;
            } else {
                // Jika id_box tidak ditemukan dalam array jumlahKadarAir,
                // hitung rata-rata kadar air baru berdasarkan data sebelumnya dan data baru
                $avgKadarAirBaru = ($avgairSebelumnya * ($banyakData - 1) + $itemObject->kadar_air) / $banyakData;
            }

            // Hitung total modal baru berdasarkan perbedaan berat
            $perbedaanBerat = $beratSebelumnya + $itemObject->berat;
            $totalModalBaru = $perbedaanBerat * $itemObject->modal;

            // Update data dengan berat dan total modal yang baru
            $dataToUpdate['berat'] = $perbedaanBerat;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $dataToUpdate['kadar_air'] = $avgKadarAirBaru;

            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            StockTransitRawMaterial::create(array_merge($dataToUpdate, [
                'nomor_bstb'    => $itemObject->nomor_bstb,
                'nomor_batch'   => $item->nomor_batch,
                'nama_supplier' => $itemObject->nama_supplier,
                'jenis'         => $itemObject->jenis,
                'tujuan_kirim'  => $itemObject->tujuan_kirim,
                'letak_tujuan'  => $itemObject->letak_tujuan,
                'inisial_tujuan'=> $itemObject->inisial_tujuan,
                'modal'         => $itemObject->modal,
                'user_created'  => $itemObject->user_created,
                'user_updated'  => $itemObject->user_updated ?? "There isn't any",
                'nomor_nota_internal'   => $itemObject->nomor_nota_internal
            ]));
        }

        // Creat Prm Raw Material Stock
        $itemObject = (object)$item;
        $existingItem = PrmRawMaterialStock::where('id_box', $itemObject->id_box)
            ->where('nomor_batch', $itemObject->nomor_batch)
            ->first();
        // return $existingItem

        $dataToUpdate = [
            'berat_masuk'   => $itemObject->berat_masuk,
            'berat_keluar'  => $itemObject->berat,
            'sisa_berat'    => $itemObject->selisih_berat,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan_item,
            'user_updated'  => $itemObject->user_created ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Ambil nilai terakhir berat_masuk dan berat_keluar
            // $lastBeratMasuk = $existingItem->berat_masuk;
            $lastBeratKeluar = $existingItem->berat_keluar;
            $beratSebelumnya = $existingItem->berat_masuk;

            $tambahBeratKeluar = $lastBeratKeluar + $itemObject->berat;
            $perbedaanBerat = $beratSebelumnya - $tambahBeratKeluar;
            $totalModalBaru = $perbedaanBerat * $itemObject->modal;

            $dataToUpdate['berat_keluar'] = $tambahBeratKeluar;
            $dataToUpdate['sisa_berat'] = $perbedaanBerat;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PrmRawMaterialStock::create(array_merge($dataToUpdate, [
                'id_box'        => $itemObject->id_box,
                'nomor_batch'   => $itemObject->nomor_batch,
                'nama_supplier' => $itemObject->nama_supplier,
                'jenis'         => $itemObject->jenis,
                'avg_kadar_air' => $itemObject->kadar_air,
                'modal'         => $itemObject->modal,
                'user_created'  => $itemObject->user_created
            ]));
        }
    }

    public function updateItem($request, $id) {
        try {
            DB::beginTransaction();
            // Update item
            $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
            $stockTGK = StockTransitRawMaterial::where('id', $id)->first();
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
