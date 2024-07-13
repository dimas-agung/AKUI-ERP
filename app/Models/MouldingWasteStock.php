<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteStock extends Model
{
    use HasFactory;
    protected $table = 'moulding_waste_stocks';
    protected $fillable = [
        'id_box_wate_moulding',
        'jenis_waste',
        'berat_masuk',
        'pcs_masuk',
        'berat_keluar',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'modal',
        'total_modal',
    ];
}
