<?php
namespace App\Services;
use App\Models\GradingKasarOutput;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
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
            'biaya_produksi'    => $item->biaya_produksi,
            'modal'             => $item->modal,
            'total_modal'       => $item->total_modal,
            'fix_total_modal'   => $item->fix_total_modal,
            'keterangan'        => $item->keterangan,
            'user_created'      => $item->user_created,
            'user_updated'      => $item->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);

        StockTransitGradingKasar::create([
            'nomor_bstb'            => $item->nomor_bstb,
            'id_box_grading_kasar'  => $item->id_box_grading_kasar,
            'nomor_batch'           => $item->nomor_batch,
            'nomor_job'             => $item->nomor_job,
            'nama_supplier'         => $item->nama_supplier,
            'nomor_nota_internal'   => $item->nomor_nota_internal,
            'id_box_raw_material'   => $item->id_box_raw_material,
            'jenis_raw_material'    => $item->jenis_raw_material,
            'jenis_grading'         => $item->jenis_grading,
            'berat_keluar'          => $item->berat_keluar,
            'pcs_keluar'            => $item->pcs_keluar,
            'avg_kadar_air'         => $item->avg_kadar_air,
            'tujuan_kirim'      => $item->tujuan_kirim,
            'nomor_grading'     => $item->nomor_grading,
            'biaya_produksi'    => $item->biaya_produksi,
            'modal'             => $item->modal,
            'total_modal'       => $item->total_modal,
            'fix_total_modal'   => $item->fix_total_modal,
            'keterangan'        => $item->keterangan,
            'user_created'      => $item->user_created,
            'user_updated'      => $item->user_updated ?? "There isn't any",
        // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
    }
}
