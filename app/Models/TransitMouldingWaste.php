<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitMouldingWaste extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'transit_moulding_wastes';
    protected $fillable = [
        'unit',
        'id_box_waste_moulding',
        'jenis_waste',
        'berat',
        'pcs',
        'tujuan_kirim',
        'nomor_job',
        'nomor_bstb',
        'status',
        'modal',
        'total_modal',
    ];
    // public function DryAWasteOutput()
    // {
    //     return $this->hasOne(DryAWasteOutput::class, 'jenis_waste', 'jenis_waste');
    // }
}
