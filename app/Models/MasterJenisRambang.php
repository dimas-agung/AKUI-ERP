<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisRambang extends Model
{
    use HasFactory;
    protected $table = 'master_jenis_rambangs';
    protected $fillable =
    [
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
