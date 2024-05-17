<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitCabutBulu extends Model
{
    use HasFactory;
    protected $table = 'transit_cabut_bulus';
    protected $fillable = [
        'workstation',
        'unit',
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'upah_operator',
        'keterangan',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'modal',
        'total_modal',
        'status',
    ];
    public function CabutBuluPengembalian()
    {
        return $this->belongsTo(CabutBuluPengembalian::class, 'nomor_job', 'nomor_job');
    }
}
