<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreWashOutput extends Model
{
    use HasFactory;
    protected $table = 'pre_wash_outputs';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'status',
        'nomor_bstb',
        'operator_perendaman',
        'operator_bilas',
        'operator_box',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function PreWashStock()
    {
        return $this->belongsTo(PreWashStock::class, 'nomor_job', 'nomor_job');
    }
    public function TransitPreWash()
    {
        return $this->hasMany(TransitPreWash::class, 'nomor_job', 'nomor_job');
    }
}
