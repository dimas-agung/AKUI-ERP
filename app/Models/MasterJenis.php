<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenis extends Model
{
    use HasFactory;
    protected $table ='master_jenis_raw_material';

    protected $fillable = [
        'datetime',
        'jenis',
        'kategori_susut',
        'upah_operator',
        'pengurangan_harga',
        'harga_estimasi',
        'status',
    ];
}
