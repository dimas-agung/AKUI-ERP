<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutBuluPenyebaran extends Model
{
    use HasFactory;
    protected $table = 'cabut_bulu_penyebarans';
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
}
