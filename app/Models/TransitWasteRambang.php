<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitWasteRambang extends Model
{
    use HasFactory;
    protected $table = 'transit_waste_rambangs';
    protected $fillable = [
        'unit',
        'nomor_bstb',
        'jenis_rambang',
        'berat',
        'status',
    ];
}
