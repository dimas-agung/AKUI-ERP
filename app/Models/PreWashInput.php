<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreWashInput extends Model
{
    use HasFactory;
    protected $table = 'pre_wash_inputs';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'upah_operator',
        'tujuan_kirim',
        'keterangan',
        'nomor_bstb',
        'status',
        'modal',
        'total_modal',
        'nomor_partai',
        'user_created',
        'user_updated',
    ];
    public function TransitGradingHalus()
    {
        return $this->hasMany(TransitGradingHalus::class, 'nomor_job', 'nomor_job');
    }
}
