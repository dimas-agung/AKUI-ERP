<?php

namespace App\Services;

use App\Models\GradingKasarHasil;
use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStockHistory;
use App\Models\PrmRawMaterialStock;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HppService
{

    function calculate(array $berats, array $harga_estimasi, array $totalModal): array
    {
        $sum_total_harga = 0;
        $sum_total_modal = 0;
        $sum_nilai_setelah_dikurangi_keuntungan = 0;

        $dataHpp = [];
        foreach ($berats as $key => $berat) {
            $total_harga = $berat * $harga_estimasi[$key];
            $total_modal = $totalModal[$key];
            $sum_total_harga += $total_harga;
            $sum_total_modal += $total_modal;
            $dataHpp[] = [
                'berat' => $berat,
                'harga_estimasi' => $harga_estimasi[$key],
                'total_harga' => $total_harga,
                'total_modal' => $total_modal,
            ];
        }
        foreach ($dataHpp as $key => $value) {
            $total_modal = $value['total_modal'];
            $total_harga = $value['total_harga'];
            $nilai_laba_rugi = ($sum_total_harga - $total_modal) / $total_modal;
            $nilai_prosentase_total_keuntungan =  $total_harga * $nilai_laba_rugi;
            $nilai_setelah_dikurangi_keuntungan =  $total_harga - $nilai_prosentase_total_keuntungan;

            $sum_nilai_setelah_dikurangi_keuntungan += $nilai_setelah_dikurangi_keuntungan;
            $dataHpp[$key]['nilai_laba_rugi'] = $nilai_laba_rugi;
            $dataHpp[$key]['nilai_prosentase_total_keuntungan'] = $nilai_prosentase_total_keuntungan;
            $dataHpp[$key]['nilai_setelah_dikurangi_keuntungan'] = $nilai_setelah_dikurangi_keuntungan;
        }
        foreach ($dataHpp as $key => $value) {
            $berat = $value['berat'];
            $harga_estimasi = $value['harga_estimasi'];
            $nilai_setelah_dikurangi_keuntungan = $value['nilai_setelah_dikurangi_keuntungan'];
            $prosentase_harga_gramasi = $nilai_setelah_dikurangi_keuntungan / $sum_nilai_setelah_dikurangi_keuntungan;
            $selisih_laba_rugi_kg = $prosentase_harga_gramasi * ($sum_total_harga - $total_modal);
            $selisih_laba_rugi_gram = $selisih_laba_rugi_kg / $berat;
            $hpp = $harga_estimasi - $selisih_laba_rugi_gram;
            $total_hpp = $hpp * $berat;
            $dataHpp[$key]['prosentase_harga_gramasi'] = $prosentase_harga_gramasi;
            $dataHpp[$key]['selisih_laba_rugi_kg'] = round($selisih_laba_rugi_kg, 2);
            $dataHpp[$key]['selisih_laba_rugi_gram'] = round($selisih_laba_rugi_gram, 2);
            $dataHpp[$key]['hpp'] = round($hpp, 2);
            $dataHpp[$key]['total_hpp'] = round($total_hpp, 2);
        }
        return $dataHpp;
    }
}
