<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPersiapanRework extends Model
{
    use HasFactory;
    protected $table = 'moulding_persiapan_reworks';
    protected $fillable = [
        'nomor_job_rework',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'berat_job',
        'pcs_job',
        'modal',
        'total_modal',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'user_created',
        'user_updated',
        'status',
    ];

    public function TransitFinalGradingRework()
    {
        return $this->belongsTo(TransitFinalGradingRework::class, 'nomor_job_rework', 'nomor_job_rework');
    }
}
