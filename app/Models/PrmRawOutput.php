<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawOutput extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_output';
    protected $fillable = [
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'kadar_air',
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'nomor_bstb',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin'
    ];
}
