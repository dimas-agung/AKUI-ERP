<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitCabutBuluHancuran extends Model
{
    use HasFactory;
    protected $table = 'transit_cabut_bulu_hancurans';
    protected $fillable = [
        'unit',
        'nomor_job',
        'jenis_rambang',
        'upah_operator',
        'berat',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'waktu_penyebaran',
        'waktu_pengembalian',
        'status',
    ];
    public function CabutHancuranPengembalian()
    {
        return $this->belongsTo(CabutHancuranPengembalian::class, 'nomor_job', 'nomor_job');
    }
    public function DryAPenerimaanHancuran()
    {
        return $this->hasMany(DryAPenerimaanHancuran::class, 'nomor_job', 'nomor_job');
    }
}
