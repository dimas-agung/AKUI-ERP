<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteOutput extends Model
{
    use HasFactory;
    protected $table = 'moulding_waste_outputs';
    protected $fillable = [
        'asal_stock',
        'id_box',
        'jenis',
        'tujuan_kirim',
        'nomor_job',
        'nomor_bstb',
        'berat',
        'pcs',
        'keterangan',
        'status',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
}
