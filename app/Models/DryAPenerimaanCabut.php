<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAPenerimaanCabut extends Model
{
    use HasFactory;
    protected $table = 'dry_a_penerimaan_cabuts';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'modal',
        'total_modal',
        'upah_operator',
        'user_created',
        'user_updated',
        'status',
    ];
}
