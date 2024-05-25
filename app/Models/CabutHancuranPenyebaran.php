<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutHancuranPenyebaran extends Model
{
    use HasFactory;
    protected $table = 'cabut_hancuran_penyebarans';
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
        'status',
        'user_created',
        'user_updated',
    ];
    public function CabutHancuranPersiapanStock()
    {
        return $this->hasMany(CabutHancuranPersiapanStock::class, 'nomor_job', 'nomor_job');
    }
    public function CabutHancuranPengembalian()
    {
        return $this->hasMany(CabutHancuranPengembalian::class, 'nomor_job', 'nomor_job');
    }
}
