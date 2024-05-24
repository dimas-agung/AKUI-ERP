<?php

namespace App\Services;

use App\Models\PreGradingHalusAdding;
use App\Models\PreGradingHalusAddingStock;
use App\Models\PreGradingHalusInput;
use App\Models\PreGradingHalusStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Operator;

class PreGradingHalusAddingService
{
    public function simpanData($dataArray)
    {
        try {
            DB::beginTransaction();

            // Buat array sementara untuk menyimpan data yang digabungkan
            $groupedData = [];

            foreach ($dataArray as $item) {
                // Periksa apakah nomor_grading sudah ada dalam array sementara
                if (array_key_exists($item->nomor_grading, $groupedData)) {
                    // Jika ya, tambahkan nilai berat_kirim, pcs_kirim, dan total_modal
                    $groupedData[$item->nomor_grading]['total_berat_kirim'] += $item->berat_kirim;
                    $groupedData[$item->nomor_grading]['total_pcs_kirim'] += $item->pcs_kirim;
                    $groupedData[$item->nomor_grading]['total_modal'] += $item->total_modal;
                } else {
                    // Jika tidak, tambahkan data baru ke array sementara
                    $groupedData[$item->nomor_grading] = [
                        'total_berat_kirim' => $item->berat_kirim,
                        'total_pcs_kirim' => $item->pcs_kirim,
                        'total_modal' => $item->total_modal,
                    ];
                }

                // Tambahkan item baru ke tabel PreGradingHalusAdding
                $this->createItem($item);
            }

            // Simpan data yang telah digabungkan ke dalam tabel PreGradingHalusAddingStock
            foreach ($groupedData as $nomorGrading => $data) {
                PreGradingHalusAddingStock::create([
                    'unit'                  => $item->unit ?? "Grading Halus",
                    'nomor_grading'         => $item->nomor_grading,
                    'id_box_grading_kasar'  => $item->id_box_grading_kasar,
                    'nomor_batch'           => $item->nomor_batch,
                    'nomor_nota_internal'   => $item->nomor_nota_internal,
                    'nama_supplier'         => $item->nama_supplier,
                    'jenis_raw_material'    => $item->jenis_raw_material,
                    'kadar_air'             => $item->kadar_air,
                    'nomor_grading'         => $nomorGrading,
                    'berat_adding'          => $data['total_berat_kirim'],
                    'pcs_adding'            => $data['total_pcs_kirim'],
                    'modal'                 => $data['total_modal'] / $data['total_berat_kirim'],
                    'total_modal'           => $data['total_berat_kirim'] * ($data['total_modal'] / $data['total_berat_kirim']),
                    'status_stock'          => $item->status_stock ?? 1,
                    'id_box_raw_material'   => $item->id_box_raw_material,
                ]);
            }

            // Ambil PreGradingHalusAdding berdasarkan nomor_job dan id_box_grading_kasar
            $PreGradingHalusAdding = PreGradingHalusAdding::where('nomor_job', $dataArray[0]->nomor_job)
                ->where('id_box_grading_kasar', $dataArray[0]->id_box_grading_kasar)
                ->first();

            // Ambil PreGradingHalusInput berdasarkan nomor_job dan id_box_grading_kasar dari PreGradingHalusAdding
            $PreGradingHalusInput = PreGradingHalusInput::where('nomor_job', $PreGradingHalusAdding->nomor_job)
                ->where('id_box_grading_kasar', $PreGradingHalusAdding->id_box_grading_kasar)
                ->first();

            if ($PreGradingHalusInput) {
                $PreGradingHalusInput->update([
                    'status' => 0,
                ]);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('PreGradingHalusAdding.index'), // Ganti dengan nama route yang sesuai
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
        // Tambahkan item baru ke tabel PreGradingHalusAdding
        PreGradingHalusAdding::create([
            'nomor_grading' => $item->nomor_grading,
            'nomor_job' => $item->nomor_job,
            'id_box_grading_kasar' => $item->id_box_grading_kasar,
            'id_box_raw_material' => $item->id_box_raw_material,
            'nomor_batch' => $item->nomor_batch,
            'nomor_nota_internal' => $item->nomor_nota_internal,
            'nama_supplier' => $item->nama_supplier,
            'jenis_raw_material' => $item->jenis_raw_material,
            'kadar_air' => $item->kadar_air,
            'jenis_kirim' => $item->jenis_kirim,
            'berat_kirim' => $item->berat_kirim,
            'pcs_kirim' => $item->pcs_kirim,
            'tujuan_kirim' => $item->tujuan_kirim,
            'modal' => $item->modal,
            'total_modal' => $item->total_modal,
            'user_created' => $item->user_created ?? "There isn't any",
            // 'user_updated'          => $item->user_updated ?? "Admin123",
        ]);

        // test Pre Grading Halus Stock
        $itemObject = (object)$item;
        $existingItem = PreGradingHalusStock::where('nomor_job', $itemObject->nomor_job)
            ->where('id_box_grading_kasar', $itemObject->id_box_grading_kasar)
            ->first();

        $dataToUpdate = [
            'total_modal'   => $itemObject->total_modal,
            'user_updated'  => $itemObject->user_created ?? "Tes",
        ];

        if ($existingItem) {
            $tambahBeratKeluar = $existingItem->berat_keluar + $itemObject->berat_kirim;
            $tambahPcsKeluar = $existingItem->pcs_keluar + $itemObject->pcs_kirim;

            $totalModalBaru = $tambahBeratKeluar * $itemObject->modal;

            $dataToUpdate['berat_keluar'] = $tambahBeratKeluar;
            $dataToUpdate['pcs_keluar'] = $tambahPcsKeluar;
            $dataToUpdate['sisa_berat'] = $existingItem->berat_masuk - $tambahBeratKeluar;
            $dataToUpdate['sisa_pcs'] = $existingItem->pcs_masuk - $tambahPcsKeluar;
            $dataToUpdate['total_modal'] = $totalModalBaru;
            $existingItem->update($dataToUpdate);
        } else {
            // Jika item tidak ada, buat item baru dalam database
            PreGradingHalusStock::create(array_merge($dataToUpdate, [
                'unit'                              => $item->unit ?? "Pre Cleaning",
                'nomor_job'                         => $item->nomor_job,
                'id_box_grading_kasar'              => $item->id_box_grading_kasar,
                'nomor_bstb'                        => $item->nomor_bstb,
                'id_box_raw_material'               => $item->id_box_raw_material,
                'nomor_batch'                       => $item->nomor_batch,
                'nomor_nota_internal'               => $item->nomor_nota_internal,
                'nama_supplier'                     => $item->nama_supplier,
                'jenis_raw_material'                => $item->jenis_raw_material,
                'kadar_air'                         => $item->kadar_air,
                'jenis_kirim'                       => $item->jenis_kirim,
                'berat_masuk'                       => $item->berat_masuk ?? 0,
                'pcs_masuk'                         => $item->pcs_masuk ?? 0,
                'sisa_berat'                        => $item->berat_masuk - $item->berat_kirim,
                'sisa_pcs'                          => $item->pcs_masuk - $item->pcs_kirim,
                'tujuan_kirim'                      => $item->tujuan_kirim,
                'modal'                             => $item->modal,
                'user_created'                      => $item->user_created ?? "There isn't any",
            ]));
        }
    }
}
