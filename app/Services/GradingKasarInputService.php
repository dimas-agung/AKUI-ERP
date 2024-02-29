<?php
namespace App\Services;
use App\Models\GradingKasarInput;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\StockTransitGradingKasar;
use App\Models\StockTransitRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradingKasarInputService
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
                'redirectTo' => route('GradingKasarInput.index'), // Ganti dengan nama route yang sesuai
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
        GradingKasarInput::create([
            'nomor_bstb'           => $item->nomor_bstb,
            'id_box'               => $item->id_box,
            'nomor_batch'          => $item->nomor_batch,
            'nama_supplier'        => $item->nama_supplier,
            'jenis_raw_material'   => $item->jenis,
            'nomor_nota_internal'  => $item->nomor_nota_internal,
            'kadar_air'            => $item->kadar_air,
            'berat'                => $item->berat,
            'nomor_grading'        => $item->nomor_grading,
            'modal'                => $item->modal,
            'total_modal'          => $item->total_modal,
            'keterangan'           => $item->keterangan,
            'user_created'         => $item->user_created,
            'user_updated'         => $item->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        $itemObject = (object) $item;
        $existingItem = StockTransitRawMaterial::where('nama_supplier', $itemObject->nama_supplier)
            ->where('nomor_bstb', $itemObject->nomor_bstb)
            ->first();

        $dataToUpdate = [
            'berat'                => $itemObject->berat ?? 0,
            'total_modal'          => $itemObject->total_modal,
            'user_updated'         => $itemObject->user_created ?? "There isn't any",
        ];

        if ($existingItem) {
            // Ambil berat sebelumnya
            $beratSebelumnya = $existingItem->berat;

            // Hitung total modal baru berdasarkan perbedaan berats
            $perbedaanBerat = $beratSebelumnya - $itemObject->berat;
            $totalModalBaru = $perbedaanBerat * $itemObject->modal;
            // $totalModalBaru = $existingItem->total_modal + ($perbedaanBerat * $itemObject->modal);

            // Update data dengan berat dan total modal yang baru
            $dataToUpdate['berat'] = $perbedaanBerat;
            $dataToUpdate['total_modal'] = $totalModalBaru;

            // Perbarui data
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru dengan nilai lainnya tetap sama
            StockTransitRawMaterial::create(array_merge($dataToUpdate, [
                'id_box'               => $itemObject->id_box,
                'nomor_batch'          => $itemObject->nomor_batch,
                'jenis'                => $itemObject->jenis,
                'kadar_air'            => $itemObject->kadar_air,
                'tujuan_kirim'         => $itemObject->tujuan_kirim,
                'letak_tujuan'         => $itemObject->letak_tujuan,
                'inisial_tujuan'       => $itemObject->inisial_tujuan,
                'modal'                => $itemObject->modal,
                'keterangan'           => $itemObject->keterangan,
                'user_created'         => $itemObject->user_updated ?? "There isn't any",
                'nomor_nota_internal'  => $itemObject->nomor_nota_internal,
                // Sesuaikan dengan kolom-kolom lain di tabel item Anda
            ]));
        }

        $itemObject = (object) $item;
        $existingItems = PrmRawMaterialOutputItem::where('nama_supplier', $itemObject->nama_supplier)
            ->where('id_box', $itemObject->id_box)
            ->get();

            foreach ($existingItems as $existingItem) {
                // Perbarui data untuk setiap item yang ada
                $existingItem->update(['status' => 0]);
            }
    }
}
