<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialOutputItem extends Model
{
    use HasFactory;
    protected $table = '';
    protected $fillable = [
        'doc_no',
        'nomor_bstb',
        'nomor_batch',
        'id_box',
        'nama_supplier',
        'jenis',
        'berat',
        'kadar_air',
        'tujuan_kirim',
        'letak_tujuan',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated'
    ];
}
