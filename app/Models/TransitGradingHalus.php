<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitGradingHalus extends Model
{
    use HasFactory;
    protected $table = 'transit_grading_haluses';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'status',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'nomor_bstb',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];

    public function GradingHalusOutput()
    {
        return $this->hasMany(GradingHalusOutput::class, 'nomor_job', 'nomor_job');
    }
}
