<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAPenerimaanHancuran extends Model
{
    use HasFactory;
    protected $table = 'dry_a_penerimaan_hancurans';
    protected $fillable = [
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
        'user_created',
        'user_updated',
        'status',
    ];
    public function TransitCabutBuluHancuran()
    {
        return $this->belongsTo(TransitCabutBuluHancuran::class, 'nomor_job', 'nomor_job');
    }
    public function DryAPenerimaanHancuranStock()
    {
        return $this->hasMany(DryAPenerimaanHancuranStock::class, 'nomor_job', 'nomor_job');
    }
}
