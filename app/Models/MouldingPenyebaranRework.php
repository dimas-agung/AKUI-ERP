<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPenyebaranRework extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    const STATUS_ON_PROSES = 2;
    const STATUS_FINISHED = 3;
    protected $table = 'moulding_penyebaran_reworks';
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
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'keterangan',
        'user_created',
        'user_updated',
        'status',
    ];
    public function can_delete()
    {
        if ($this->status != self::STATUS_NON_AKTIF) {
            return true;
        }
        return false;
    }
    public function MouldingPenyebaranRework()
    {
        return $this->hasMany(MouldingPenyebaranRework::class, 'nomor_job_rework', 'nomor_job_rework');
    }
}
