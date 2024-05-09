<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanWaste extends Model
{
    use HasFactory;
    protected $table = 'pengiriman_wastes';
    protected $fillable = [
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat',
        'nomor_bstb',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
}
