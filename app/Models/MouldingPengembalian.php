<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPengembalian extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    const STATUS_ON_PROSES = 2;
    const STATUS_FINISHED = 3;
    protected $table = 'moulding_pengembalians';
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
        'waktu_pengembalian',
        'lama_pengerjaan',
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
        if ($this->status == self::STATUS_FINISHED) {
            return true;
        }
        return false;
    }
    public function MouldingPenyebaran()
    {
        return $this->hasMany(MouldingPenyebaran::class, 'nomor_job', 'nomor_job');
    }
}
