<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAPenerimaanCabutStock extends Model
{
    use HasFactory;
    protected $table = 'dry_a_penerimaan_cabut_stocks';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'modal',
        'total_modal',
        'upah_operator',
        'status',
    ];
}
