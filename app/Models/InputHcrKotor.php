<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputHcrKotor extends Model
{
    use HasFactory;
    protected $table = 'input_hcr_kotors';
    protected $fillable = [
        'tanggal_cabut',
        'jenis_hcr_kotor',
        'berat_hcr_kotor',
        'id_box_hcr_kotor',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
}
