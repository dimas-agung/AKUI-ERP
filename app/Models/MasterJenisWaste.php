<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisWaste extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'master_jenis_wastes';
    protected $fillable = [
        'jenis',
        'kategori_susut',
        'upah_operator',
        'pengurangan_harga',
        'harga_estimasi',
        'status',
        'user_created',
        'user_updated',
    ];
}
