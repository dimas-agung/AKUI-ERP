<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputRambangBasah extends Model
{
    use HasFactory;
    protected $table = 'input_rambang_basahs';
    protected $fillable = [
        'id_box_hcr_kotor',
        'tanggal_cabut',
        'jenis_hcr_kotor',
        'berat_hcr_kotor',
        'jenis_rambang',
        'berat',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
}
