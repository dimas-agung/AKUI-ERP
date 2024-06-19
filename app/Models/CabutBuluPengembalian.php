<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutBuluPengembalian extends Model
{
    use HasFactory;
    protected $table = 'cabut_bulu_pengembalians';
    Public const STATUS_NON_AKTIF = 0;
    Public const STATUS_ON_STOCK = 1;
    Public const STATUS_ON_PROSES = 2;
    Public const STATUS_FINISHED = 3;
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'upah_operator',
        'waktu_penyebaran',
        'lama_pengerjaan',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'waktu_pengembalian',
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
    public function CabutBuluPenyebaran()
    {
        return $this->belongsTo(CabutBuluPenyebaran::class, 'nomor_job', 'nomor_job');
    }
    public function TransitCabutBulu()
    {
        return $this->hasMany(TransitCabutBulu::class, 'nomor_job', 'nomor_job');
    }
    Public function can_delete (){
        if ($this->status == self::STATUS_FINISHED){
            return true;
        }
        return false;
    }
}
