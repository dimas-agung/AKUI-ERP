<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPenyebaran extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    const STATUS_ON_PROSES = 2;
    const STATUS_FINISHED = 3;
    protected $table = 'moulding_penyebarans';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'berat_job',
        'pcs_job',
        'modal_nomor_job',
        'total_modal_nomor_job',
        'upah_operator',
        'waktu_penyebaran',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
    public function can_delete()
    {
        if ($this->status == self::STATUS_ON_PROSES) {
            return true;
        }
        return false;
    }
    public function MouldingStock()
    {
        return $this->hasMany(MouldingStock::class, 'nomor_job', 'nomor_job');
    }
}
