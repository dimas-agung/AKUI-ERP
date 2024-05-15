<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitRambangWaste extends Model
{
    use HasFactory;
    protected $table = 'transit_rambang_wastes';
    protected $fillable = [
        'unit',
        'nomor_bstb',
        'jenis_rambang',
        'berat',
        'status',
    ];
}
