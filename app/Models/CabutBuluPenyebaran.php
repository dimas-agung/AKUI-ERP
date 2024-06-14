<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutBuluPenyebaran extends Model
{
    use HasFactory;
    protected $table = 'cabut_bulu_penyebarans';
    const STATUS_NON_AKTIF = 0;
    const STATUS_ON_STOCK = 1;
    const STATUS_ON_PROSES = 2;
    const STATUS_FINISHED = 3;
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'upah_operator',
        'waktu_penyebaran',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'keterangan_2',
        'user_created',
        'user_updated',
        'status',
    ];
    public function CabutBuluStock()
    {
        return $this->hasMany(CabutBuluStock::class, 'nomor_job', 'nomor_job');
    }
    public function can_delete()
    {
        if ($this->status == self::STATUS_ON_PROSES) {
            return true;
        }
        return false;
    }
}
