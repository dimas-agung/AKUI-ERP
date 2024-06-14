<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutBuluStock extends Model
{
    use HasFactory;
    protected $table = 'cabut_bulu_stocks';
    Public const STATUS_NON_AKTIF = 0;
    Public const STATUS_ON_STOCK = 1;
    Public const STATUS_ON_PROSES = 2;
    Public const STATUS_FINISHED = 3;
    protected $fillable = [
        'workstation',
        'unit',
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'upah_operator',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'status',
    ];
    public function CabutBuluPenyebaran()
    {
        return $this->hasMany(CabutBuluPenyebaran::class, 'nomor_job', 'nomor_job');
    }
    public function CabutBuluPengembalian()
    {
        return $this->belongsTo(CabutBuluPengembalian::class, 'nomor_job', 'nomor_job');
    }
}
