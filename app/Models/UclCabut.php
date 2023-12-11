<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UclCabut extends Model
{
    use HasFactory;
    protected $table = 'ucl_cabut';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'modal',
        'total_modal',
        'nip_operator',
        'nama_operator',
        'waktu_ambil',
        'keterangan_ambil',
        'timestamp_ambil',
        'nip_admin_ambil',
        'waktu_kembali',
        'keterangan_kembali',
        'timestamp_kembali',
        'nip_admin_kembali',
    ];
}
