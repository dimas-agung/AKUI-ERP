<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteStock extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'moulding_waste_stocks';
    protected $fillable = [
        'unit',
        'id_box_waste_moulding',
        'jenis_waste',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'pcs_masuk',
        'pcs_keluar',
        'sisa_pcs',
        'modal',
        'total_modal',
        'status',
    ];
}
