<?php
namespace App\Services;
use App\Models\PrmRawMaterialOutputHeader;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialOutputService
{
    public function sendData($dataHeader, $dataArray)
    {
        try {
            DB::beginTransaction();

            $this->createHeader($dataHeader);

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }

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

    private function createHeader($dataHeader)
    {
        PrmRawMaterialOutputHeader::create([
            'doc_no'        => $dataHeader->doc_no,
            'nomor_bstb'    => $dataHeader->nomor_bstb,
            'nomor_batch'   => $dataHeader->nomor_batch,
            'keterangan'    => $dataHeader->keterangan,
            'user_created'  => $dataHeader->user_created,
            'user_updated'  => $dataHeader->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel header Anda
        ]);
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
            'inisial_tujuan'=> $item->inisial_tujuan,
            'modal'         => $item->modal,
            'total_modal'   => $item->total_modal,
            'keterangan_item'=> $item->keterangan_item,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        // Creat Stock Transit Grading Kasar
        $itemObject = (object)$item;
        $existingItem = StockTransitGradingKasar::where('nama_supplier', $itemObject->nama_supplier)
            ->where('nomor_bstb', $itemObject->nomor_bstb)
            ->first();
            // return $existingItem

        $dataToUpdate = [
            'nomor_bstb'    => $itemObject->nomor_bstb,
            'nama_supplier' => $itemObject->nama_supplier,
            'jenis'         => $itemObject->jenis,
            'berat'         => $itemObject->berat,
            'kadar_air'     => $itemObject->kadar_air,
            'tujuan_kirim'  => $itemObject->tujuan_kirim,
            'letak_tujuan'  => $itemObject->letak_tujuan,
            'inisial_tujuan'=> $itemObject->inisial_tujuan,
            'modal'         => $itemObject->modal,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan_item,
            'user_created'  => $itemObject->user_created,
            'user_updated'  => $itemObject->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Jika item sudah ada, perbarui data
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            StockTransitGradingKasar::create($dataToUpdate);
        }


        // Creat Prm Raw Material Stock History
        PrmRawMaterialStockHistory::create([
            'id_box'        => $itemObject->id_box,
            'doc_no'   => $itemObject->doc_no,
            'berat_masuk'   => $itemObject->berat_masuk,
            'berat_keluar'  => $itemObject->berat,
            'sisa_berat'    => $itemObject->selisih_berat,
            'avg_kadar_air' => $itemObject->kadar_air,
            'modal'         => $itemObject->modal,
            'total_modal'   => $itemObject->total_modal,
            'keterangan'    => $itemObject->keterangan_item,
            'user_created'  => $itemObject->user_created,
            'user_updated'  => $itemObject->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);


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
            'user_updated'  => $itemObject->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ];

        if ($existingItem) {
            // Jika item sudah ada, perbarui data
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru
            PrmRawMaterialStock::create($dataToUpdate);
        }
    }

    public function updateItem($request, $id) {
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
            'nama_supplier'=> 'required',
            'jenis'        => 'required',
            'berat'        => 'required',
            'kadar_air'    => 'required',
            'tujuan_kirim' => 'required',
            'letak_tujuan' => 'required',
            'inisial_tujuan'=> 'required',
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
