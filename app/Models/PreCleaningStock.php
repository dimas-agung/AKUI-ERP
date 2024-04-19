<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreCleaningStock extends Model
{
    use HasFactory;
    protected $table = 'pre_cleaning_stocks';
    protected $fillable = [
        'unit',
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'id_box_raw_material',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'jenis_raw_material',
        'kadar_air',
        'jenis_kirim',
        'berat_masuk',
        'berat_keluar',
        'pcs_masuk',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'tujuan_kirim',
        'modal',
        'total_modal',
        'keterangan',
        'nomor_grading',
        'user_created',
        'user_updated',
    ];
    public function PreCleaningOutput()
    {
        return $this->hasMany(PreCleaningOutput::class, 'nomor_job', 'nomor_job');
    }
}
