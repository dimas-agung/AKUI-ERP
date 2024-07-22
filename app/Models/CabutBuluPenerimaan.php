<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutBuluPenerimaan extends Model
{
    use HasFactory;
    protected $table = 'cabut_bulu_penerimaans';
    Public const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    const STATUS_ON_PROSES = 2;
    const STATUS_FINISHED = 3;
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'status',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'upah_operator',
        'tujuan_kirim',
        'keterangan',
        'nomor_bstb',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function TransitPreWash()
    {
        return $this->belongsTo(TransitPreWash::class, 'nomor_bstb', 'nomor_bstb');
    }
    Public function can_delete (){
        if ($this->status == self::STATUS_ON_STOCK){
            return true;
        }
        return false;
    }
}
