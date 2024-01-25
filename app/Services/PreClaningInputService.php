<?php

namespace App\Services;

use App\Models\PreCleaningInput;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreClaningInputService
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
                'redirectTo' => route('PreCleaningInput.index'), // Sesuaikan dengan nama route yang sesuai
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
        // Validasi data sebelum membuat item
        $validator = Validator::make($item, [
            'doc_no' => 'required',
            'nomor_job' => 'required',
            'id_box_grading_kasar' => 'required',
            'nomor_bstb' => 'required',
            'nomor_batch' => 'required',
            'nama_supplier' => 'required',
            'nomor_nota_internal' => 'required',
            'jenis_raw_material' => 'required',
            'tujuan_kirim' => 'required',
            'nomor_grading' => 'required',
            'modal' => 'required',
            'total_modal' => 'required',
            'keterangan' => 'required',
            'user_created' => 'required'
            // ... Sesuaikan dengan kebutuhan validasi lainnya
        ]);

        if ($validator->fails()) {
            // Handle kesalahan validasi sesuai kebutuhan
            throw new \Exception('Gagal validasi data: ' . $validator->errors()->first());
        }

        // Kolom-kolom yang dapat diisi sesuai model PreCleaningInput
        $fillableColumns = array_flip((new PreCleaningInput())->getFillable());

        // Membuat array yang hanya berisi kolom-kolom yang ada pada model PreCleaningInput
        $dataToInsert = array_intersect_key([
            'doc_no' => $item['doc_no'],
            'nomor_job' => $item['nomor_job'],
            'id_box_grading_kasar' => $item['id_box_grading_kasar'],
            'nomor_bstb' => $item['nomor_bstb'],
            'nomor_batch' => $item['nomor_batch'],
            'nama_supplier' => $item['nama_supplier'],
            'nomor_nota_internal' => $item['nomor_nota_internal'],
            'id_box_row_material' => $item['id_box_raw_material'],
            'jenis_raw_material' => $item['jenis_raw_material'],
            'jenis_kirim' => $item['jenis_grading'],
            'berat_kirim' => $item['berat_keluar'],
            'pcs_kirim' => $item['pcs_keluar'],
            'kadar_air' => $item['avg_kadar_air'],
            'tujuan_kirim' => $item['tujuan_kirim'],
            'nomor_grading' => $item['nomor_grading'],
            'modal' => $item['modal'],
            'total_modal' => $item['total_modal'],
            'keterangan' => $item['keterangan'],
            'user_created' => $item['user_created'],
            'user_updated' => $item['user_updated'] ?? "There isn't any",
        ], $fillableColumns);

        try {
            // Menambahkan item ke dalam database
            $createdItem = PreCleaningInput::create($dataToInsert);

            // Jika item berhasil dibuat, Anda bisa mengembalikan data yang baru dibuat jika diperlukan
            return $createdItem;
        } catch (\Exception $e) {
            // Handle kesalahan penyimpanan data
            throw new \Exception('Gagal menyimpan data: ' . $e->getMessage());
        }
    }

}
