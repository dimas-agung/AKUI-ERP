<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitFinalGradingRework extends Model
{
    use HasFactory;
    protected $table = 'transit_final_grading_reworks';
    protected $fillable = [
        'unit',
        'nomor_job_rework',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'berat_job',
        'pcs_job',
        'modal_per_jenis',
        'total_modal_per_jenis',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'status',
    ];
    public function MouldingPengembalianRework()
    {
        return $this->hasMany(MouldingPengembalianRework::class, 'nomor_job_rework', 'nomor_job_rework');
    }
}
