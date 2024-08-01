<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitKedatangan extends Model
{
    use HasFactory;
    const STATUS_AKTIF = 1;
    const STATUS_NON_AKTIF = 0;
    protected $table = 'transit_kedatangans';
    protected $fillable = [
        'unit',
        'nomor_batch',
        'jenis',
        'berat',
        'pcs',
        'tujuan_kirim',
        'keterangan',
        'nomor_job',
        'nomor_bstb',
        'modal',
        'total_modal',
        'status',
    ];

    public function can_delete()
    {
        if ($this->status ==  self::STATUS_AKTIF) {
            return true;
        }
        return false;
    }
}
