<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHalusOutput extends Model
{
    use HasFactory;
    protected $table = 'grading_halus_outputs';
    protected $fillable = [
        'id_box_grading_halus',
        'nomor_batch',
        'status',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'nomor_job',
        'nomor_bstb',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function GradingHalusStock()
    {
        return $this->belongsTo(GradingHalusStock::class, 'id_box_grading_halus', 'id_box_grading_halus');
    }
    public function TransitGradingHalus()
    {
        return $this->hasMany(TransitGradingHalus::class, 'nomor_job', 'nomor_job');
    }
}
