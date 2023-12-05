<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ugh_grading_halus_hasil extends Model
{
    use HasFactory;
    protected $table = 'ugh_grading_halus_hasil';
    protected $fillable = [
        'nomor_grading',
        'nomor_batch',
        'nama_supplier',
        'jenis_adding',
        'berat_adding',
        'pcs_adding',
        'kadar_air',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'id_box',
        'modal',
        'total_modal',
        'hpp',
        'total_hpp',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
