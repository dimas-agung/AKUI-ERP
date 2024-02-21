<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreGradingHalusAdding extends Model
{
    use HasFactory;
    protected $table = 'pre_grading_halus_addings';
    protected $fillable = [
        'nomor_grading',
        'nomor_job',
        'id_box_grading_kasar',
        'id_box_raw_material',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'jenis_raw_material',
        'kadar_air',
        'jenis_kirim',
        'berat_kirim',
        'pcs_kirim',
        'tujuan_kirim',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function PreGradingHalusAddingStock()
    {
        return $this->hasMany(PreGradingHalusAddingStock::class, 'nomor_job', 'nomor_job');
    }
    public function Perusahaan()
    {
        return $this->hasMany(Perusahaan::class, 'nomor_job', 'nama');
    }
}
