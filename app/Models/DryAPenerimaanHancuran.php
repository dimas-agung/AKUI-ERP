<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAPenerimaanHancuran extends Model
{
    use HasFactory;
    protected $table = '';
    protected $filllable = [
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
        'user_created',
        'user_updated',
    ];
}
