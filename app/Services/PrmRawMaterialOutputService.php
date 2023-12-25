<?php

namespace App\Services;

use App\Models\PrmRawMaterialOutputHeader;
use App\Models\PrmRawMaterialOutputItem;
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
            'inisial_tujuan' => $item->inisial_tujuan,
            'modal'         => $item->modal,
            'total_modal'   => $item->total_modal,
            'keterangan_item' => $item->keterangan_item,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated,
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
    }

    public function updateItem($request, $id)
    {
        $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);

        // Validasi form
        $this->validateRequest($request);

        // Update item
        $PrmRawMOIC->update($request->all());

        return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Diubah!']);
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
