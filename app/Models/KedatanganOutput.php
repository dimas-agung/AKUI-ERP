<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KedatanganOutput extends Model
{
    use HasFactory;
    const STATUS_AKTIF = 1;
    const STATUS_NON_AKTIF = 0;
    protected $table = 'kedatangan_outputs';
    protected $fillable = [
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
        'user_created',
        'user_updated',
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
