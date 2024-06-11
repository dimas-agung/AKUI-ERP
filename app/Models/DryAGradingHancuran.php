<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAGradingHancuran extends Model
{
    use HasFactory;
    protected $table = 'dry_a_grading_hancurans';
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
        'jenis_grading',
        'berat_grading',
        'kontribusi',
        'susut_belakang',
        'status',
        'user_created',
        'user_updated',
    ];
}
