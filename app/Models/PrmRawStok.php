<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawStok extends Model
{
    use HasFactory;
    protected $table = ['prm_raw_material_stok'];
    protected $fillable = [
        'unit',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat_masuk', //sum input+output
        'berat_keluar', //sum input+output
        'sisa_berat',
        'avg_kadar_air',
        'modal',
        'total_modal'
    ];
}
