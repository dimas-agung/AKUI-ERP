<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RambangKeringInput extends Model
{
    use HasFactory;
    protected $table = 'rambang_kering_inputs';
    protected $fillable = [
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat_basah',
        'berat_kering',
        'susut',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
}
