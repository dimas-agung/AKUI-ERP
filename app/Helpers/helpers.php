<?php

if (!function_exists('generate_berat_bersih')) {
    function generate_berat_bersih($berat_kotor) {
        {
            $berat_bersih = (float)$berat_kotor/1.15;
            return floor($berat_bersih);
            // return number_format($berat_bersih,2);
        }
    }
}
if (!function_exists('generate_berat_bersih2')) {
    function generate_berat_bersih2($berat_kotor) {
        {
            $berat_bersih = (float)$berat_kotor/1.15;
            // return floor($berat_bersih,2);
            return number_format($berat_bersih,2);
        }
    }
}
if (!function_exists('generate_berat_bersih3')) {
    function generate_berat_bersih3($berat_kotor) {
        {
            $berat_bersih = (float)$berat_kotor/1.15;
            return $berat_bersih;
            // return floor($berat_bersih,2);
            return number_format($berat_bersih,2);
        }
    }
}
if (!function_exists('Rupiah')) {
    function Rupiah($value) {
        return "Rp. ". number_format($value,0,',','.');
    }
}
if (!function_exists('generate_order_no')) {
    function generate_order_no($count) {
        $prefix = 'INV'.date('Ymd');
        $nomor_penomoran = $prefix . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return $nomor_penomoran;
        // Logika fungsi Anda di sini
    }
}
