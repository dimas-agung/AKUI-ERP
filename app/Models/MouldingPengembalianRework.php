<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPengembalianRework extends Model
{
    use HasFactory;
    protected $table = 'moulding_pengembalian_reworks';
    protected $fillable = [
        'nomor_job_rework',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'berat_job',
        'pcs_job',
        'modal',
        'total_modal',
        'waktu_penyebaran',
        'waktu_pengembalian',
        'lama_pengerjaan',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'keterangan',
        'user_created',
        'user_updated',
        'status',
    ];
}
