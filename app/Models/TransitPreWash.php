<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPreWash extends Model
{
    use HasFactory;
    protected $table = 'transit_pre_washes';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'nomor_bstb',
        'status',
        'jenis_job',
        'berat_job',
        'berat_bersih',
        'pcs_job',
        'upah_operator',
        'upah_operator_bersih',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'nomor_partai',
        'user_created',
        'user_updated',
    ];
    public function CabutBuluPenerimaan()
    {
        return $this->hasMany(CabutBuluPenerimaan::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function PreWashOutput()
    {
        return $this->hasOne(PreWashOutput::class, 'nomor_job', 'nomor_job');
    }

}
