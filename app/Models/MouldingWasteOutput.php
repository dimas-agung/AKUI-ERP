<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteOutput extends Model
{
    use HasFactory;
    protected $table = 'moulding_waste_outputs';
    protected $fillable = [
        'asal_stok',
        'id_box',
        'jenis',
        'berat',
        'pcs',
        'tujuan_kirim',
        'nomor_job',
        'nomor_bstb',
        'keterangan',
        'status',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
}
