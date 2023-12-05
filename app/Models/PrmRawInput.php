<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawInput extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_input';
    protected $fillable = [
        'nomor_po',
        'nomor_batch',
        'nomor_nota_supplier',
        'nomor_nota_internal',
        'nama_supplier',
        'jenis',
        'berat_nota',
        'berat_kotor',
        'berat_bersih',
        'selisih_berat',
        'kadar_air',
        'id_box',
        'harga_nota',
        'total-harga_nota',
        'harga_deal',
        'fix_harga_deal',
        'keterangan',
        'timestamp',
        'nip_admin'
    ];
}
