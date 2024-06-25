<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitDryAWaste extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'transit_dry_a_wastes';
    protected $fillable = [
        'unit',
        'jenis_waste',
        'berat',
        'pcs',
        'tujuan_kirim',
        'nomor_job',
        'nomor_bstb',
        'status',
    ];
    public function DryAWasteOutput()
    {
        return $this->hasOne(DryAWasteOutput::class, 'jenis_waste', 'jenis_waste');
    }
}
