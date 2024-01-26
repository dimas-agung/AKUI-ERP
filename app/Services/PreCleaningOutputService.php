<?php

namespace App\Services;

use App\Models\PreCleaningOutput;
use App\Models\PreCleaningStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialInputService
{
    public function simpanData($dataArray)
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
                'redirectTo' => route('prm_raw_material_input.index'), // Ganti dengan nama route yang sesuai
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }
    }

    private function createItem($dataArray)
    {
        PreCleaningOutput::create([
            // 'doc_no'                         => $dataArray[0]->doc_no,
            'nomor_job'                         => $dataArray->nomor_job,
            'id_box_grading_kasar'              => $dataArray->id_box_grading_kasar,
            'nomor_bstb'                        => $dataArray->nomor_bstb,
            'id_box_raw_material'               => $dataArray->id_box_raw_material,
            'nomor_nota_internal'               => $dataArray->nomor_nota_internal,
            'nama_supplier'                     => $dataArray->nama_supplier,
            'jenis_raw_material'                => $dataArray->jenis_raw_material,
            'jenis_kirim'                       => $dataArray->jenis_kirim,
            'tujuan_kirim'                      => $dataArray->tujuan_kirim,
            'modal'                             => $dataArray->modal,
            'total_modal'                       => $dataArray->total_modal,
            'kadar_air'                         => $dataArray->kadar_air,
            'pcs_kirim'                         => $dataArray->pcs_kirim,
            'berat_kirim'                       => $dataArray->berat_kirim,
            'operator_sikat_dan_kompresor'      => $dataArray->operator_sikat_dan_kompresor,
            'operator_flek_dan_poles'           => $dataArray->operator_flex_dan_poles,
            'operator_flek_cutter'              => $dataArray->operator_cutter,
            'kuningan'                          => $dataArray->kuningan,
            'sterofoam'                         => $dataArray->Sterofoam,
            'karat'                             => $dataArray->karat,
            'rontokan_fisik'                    => $dataArray->rontokan_flex,
            'rontokan_bahan'                    => $dataArray->rontokan_bahan,
            'rontokan_serabut'                  => $dataArray->rontokan_bahan,
            'ws_0_0_0'                                => $dataArray->ws,
            'berat_precleaning'                 => $dataArray->berat_precleaning,
            'pcs_pre_cleaning'                               => $dataArray->pcs,
            'susut'                             => $dataArray->susut,
        ]);
    }
}
