<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAOutputHancuran extends Model
{
    use HasFactory;
    protected $table = 'dry_a_output_hancurans';
    protected $filllable = [
        'jenis_grading',
        'berat_job',
        'nomor_job',
        'nomor_bstb',
        'tujuan_kirim',
        'status',
        'user_created',
        'user_updated',
    ];
}
