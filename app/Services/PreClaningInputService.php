<?php

namespace App\Services;

use App\Models\PreCleaningInput;
use Illuminate\Support\Facades\DB;

class PreClaningInputService
{
    public function sendData($formattedData)
    {
        try {
            DB::beginTransaction();

            foreach ($formattedData as $item) {
                $this->createItem($item);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('PreCleaningInput.index'), // Ganti dengan nama route yang sesuai
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
        PreCleaningInput::create([
            'doc_no'           => $item['doc_no'],
            'nomor_bstb'           => $item['nomor_bstb'],
            'id_box_grading_kasar' => $item['id_box_grading_kasar'], // Ganti sesuai kebutuhan
            'nomor_batch'          => $item['nomor_batch'],
            'nama_supplier'        => $item['nama_supplier'],
            'jenis_raw_material'   => $item['jenis_raw_material'],
            'nomor_nota_internal'  => $item['nomor_nota_internal'],
            'id_box_raw_material'  => $item['id_box_raw_material'],
            'jenis_kirim'            => $item['avg_jenis_grading'],
            'berat_kirim'            => $item['berat_keluar'],
            'pcs_kirim'            => $item['pcs_keluar'],
            'kadar_air'            => $item['avg_kadar_air'],
            'tujuan_kirim'            => $item['avg_tujuan_kirim'],
            'nomor_grading'        => $item['nomor_grading'],
            'modal'                => $item['modal'],
            'total_modal'          => $item['total_modal'],
            'keterangan'           => $item['keterangan'],
            'user_created'         => $item['user_created'],
            'user_updated'         => $item['user_updated'] ?? null, // Sesuaikan dengan kolom-kolom lain di tabel item Anda
            // ... Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
    }
}
