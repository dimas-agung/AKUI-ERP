<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisGradingKasar extends Model
{
    use HasFactory;
    protected $table = 'master_jenis_grading_kasars';
    protected $fillable = [
        'nama',
        'kategori_susut',
        'upah_operator',
        'presentase_pengurangan_harga',
        'harga_estimasi',
        'status',
        'user_created',
        'user_updated',
    ];
}
