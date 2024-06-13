<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAPenerimaanHancuranStock extends Model
{
    use HasFactory;
    protected $table = 'dry_a_penerimaan_hancuran_stocks';
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
    public function DryAPenerimaanHancuran()
    {
        return $this->belongsTo(DryAPenerimaanHancuran::class, 'nomor_job', 'nomor_job');
    }
}
