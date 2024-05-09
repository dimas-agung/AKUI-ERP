<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RambangBasahStock extends Model
{
    use HasFactory;
    protected $table = 'rambang_basah_stocks';
    protected $fillable = [
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
    ];
}
