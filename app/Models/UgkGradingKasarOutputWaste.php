<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UgkGradingKasarOutputWaste extends Model
{
    use HasFactory;
    protected $table = 'ugk_grading_kasar_output_waste';
    protected $fillable = [
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'tujuan_Kirim',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'nomor_bstb',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
