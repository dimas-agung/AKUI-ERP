<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitMouldingRework extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'transit_moulding_reworks';
    protected $fillable = [
        'unit',
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
        'status'
    ];
}
