<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Services\PrmRawMaterialInputService;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class prmExcelImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {

        foreach ($collection as $key => $row) {
            if ($row['doc_no'] == null || $row['nomor_po']  == null) {
                continue;
            }
            // Log::info("---- ITEM " . $key + 1);
            // Log::info('log excel import nomor nota internal ' . $row["nomor_nota_internal"]);
            // return $collection;
            // Simpan data ke dalam tabel PrmRawMaterialInput
            $prmRawMaterialInput = [
                'doc_no'                    => $row['doc_no'],
                'nomor_po'                  => $row['nomor_po'],
                'nomor_batch'               => $row['nomor_batch'],
                'nomor_nota_supplier'       => $row['nomor_nota_supplier'],
                'nomor_nota_internal'       => $row['nomor_nota_internal'],
                'nama_supplier'             => $row['nama_supplier'],
                'keterangan'                => $row['keterangan'],
                // 'user_created'              => $row['user_created'],
                // 'user_updated'              => $row['user_updated'],
            ];
            // PrmRawMaterialInput::create($prmRawMaterialInput);
            // break;
            // Simpan data ke dalam tabel PrmRawMaterialInputItem
            $prmRawMaterialInputItem = [
                // 'prm_raw_material_input_id' => $prmRawMaterialInput->id,
                'doc_no'                    => $row['doc_no'],
                'nomor_po'                  => $row['nomor_po'],
                'nomor_batch'               => $row['nomor_batch'],
                'nomor_nota_supplier'       => $row['nomor_nota_supplier'],
                'nomor_nota_internal'       => $row['nomor_nota_internal'],
                'nama_supplier'             => $row['nama_supplier'],
                'keterangan'                => $row['keterangan'],
                // 'user_created'              => $row['user_created'],
                // 'user_updated'              => $row['user_updated'],
                'jenis'                     => $row['jenis'],
                'berat_nota'                => $row['berat_nota'],
                'berat_kotor'               => $row['berat_kotor'],
                'berat_bersih'              => $row['berat_bersih'],
                'berat_masuk'               => $row['berat_bersih'],
                'selisih_berat'             => $row['selisih_berat'],
                'kadar_air'                 => $row['kadar_air'],
                'avg_kadar_air'             => $row['kadar_air'],
                'id_box'                    => $row['id_box'],
                'harga_nota'                => $row['harga_nota'],
                'total_harga_nota'          => $row['total_harga_nota'],
                'harga_deal'                => $row['harga_deal'],
                'fix_harga_deal'            => $row['fix_harga_deal'],
                'keterangan'                => $row['keterangan'],
            ];
            // Log::info($prmRawMaterialInputItem);
            $PrmRawMaterialInputService = new PrmRawMaterialInputService();
            $PrmRawMaterialInputService->importHeader($prmRawMaterialInput);
            $PrmRawMaterialInputService->importItem($prmRawMaterialInputItem);
        }
    }
}
// class prmExcelImport implements ToModel, WithHeadingRow
// {
//     public function model(array $row)
//     {
//         // foreach ($rows as $key => $row) {
//         # code...
//         // Simpan PrmRawMaterialInput
//         $prmRawMaterialInput = [
//             'doc_no'                => $row['doc_no'],
//             'nomor_po'              => $row['nomor_po'],
//             'nomor_batch'           => $row['nomor_batch'],
//             'nomor_nota_supplier'   => $row['nomor_nota_supplier'],
//             'nomor_nota_internal'   => $row['nomor_nota_internal'],
//             'nama_supplier'         => $row['nama_supplier'],
//             'keterangan'            => $row['keterangan'],
//             'user_created'          => $row['user_created'],
//             'user_updated'          => $row['user_updated'],
//         ];

//         PrmRawMaterialInput::create($prmRawMaterialInput);
//         // Simpan PrmRawMaterialInputItem
//         // $prmRawMaterialInputItem = [
//         //     'jenis'                     => $row['jenis'],
//         //     'berat_nota'                => $row['berat_nota'],
//         //     'berat_kotor'               => $row['berat_kotor'],
//         //     'berat_bersih'              => $row['berat_bersih'],
//         //     'selisih_berat'             => $row['selisih_berat'],
//         //     'kadar_air'                 => $row['kadar_air'],
//         //     'id_box'                    => $row['id_box'],
//         //     'harga_nota'                => $row['harga_nota'],
//         //     'total_harga_nota'          => $row['total_harga_nota'],
//         //     'harga_deal'                => $row['harga_deal'],
//         //     'fix_harga_deal'            => $row['fix_harga_deal'],
//         //     'keterangan'                => $row['keterangan'],
//         //     'user_created'              => $row['user_created'],
//         //     'user_updated'              => $row['user_updated'],
//         // ];
//         // // $prmRawMaterialInputItem->save();
//         $PrmRawMaterialInputService = new PrmRawMaterialInputService();
//         $PrmRawMaterialInputService->createHeader($prmRawMaterialInput);
//         // $PrmRawMaterialInputService->createItem($prmRawMaterialInputItem);
//         // Mengembalikan true sebagai tanda bahwa impor berhasil
//         // return true;
//         // }
//     }
// }

// class prmExcelImport implements ToCollection, WithHeadingRow
// {
//     protected $PrmRawMaterialInputService;

//     public function __construct()
//     {
//         $this->PrmRawMaterialInputService = new PrmRawMaterialInputService();
//     }
//     // store
//     public function collection(Collection $rows)
//     {
//         foreach ($rows as $row) {
//             // Simpan data ke dalam tabel PrmRawMaterialInput
//             $dataHeader = [
//                 'doc_no'                => $row->doc_no,
//                 'nomor_po'              => $row->nomor_po,
//                 'nomor_batch'           => $row->nomor_batch,
//                 'nomor_nota_supplier'   => $row->nomor_nota_supplier,
//                 'nomor_nota_internal'   => $row->nomor_nota_internal,
//                 'nama_supplier'         => $row->nama_supplier,
//                 'keterangan'            => $row->keterangan,
//                 'user_created'          => $row->user_created,
//                 'user_updated'          => $row->user_updated,
//             ];

//             // Simpan data ke dalam tabel PrmRawMaterialInputItem
//             $dataArray = [
//                 'prm_raw_material_input_id' => $prmRawMaterialInput->id,
//                 'jenis'                     => $row->jenis,
//                 'berat_nota'                => $row->berat_nota,
//                 'berat_kotor'               => $row->berat_kotor,
//                 'berat_bersih'              => $row->berat_bersih,
//                 'selisih_berat'             => $row->selisih_berat,
//                 'kadar_air'                 => $row->kadar_air,
//                 'id_box'                    => $row->id_box,
//                 'harga_nota'                => $row->harga_nota,
//                 'total_harga_nota'          => $row->total_harga_nota,
//                 'harga_deal'                => $row->harga_deal,
//                 'keterangan_item'           => $row->keterangan_item,
//             ];
//             $this->PrmRawMaterialInputService->simpanData($dataHeader, $dataArray);
//         }
//         // $dataHeader = $rows->shift()->toArray(); // Ambil baris pertama sebagai data header
//         // $dataArray = $rows->toArray(); // Sisanya adalah data item
//         // return $dataArray;
//     }
// }
