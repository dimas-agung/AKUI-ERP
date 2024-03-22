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
        'nomor_batch',
        'nama_supplier',
        'nomor_nota_internal',
        'id_box_raw_material',
        'jenis_raw_material',
        'tujuan_kirim',
        'jenis_kirim',
        'berat_masuk',
        'pcs_masuk',
        'berat_keluar',
        'sisa_berat',
        'pcs_keluar',
        'sisa_pcs',
        'kadar_air',
        'nomor_grading',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];
    public function preCleaningInputs()
    {
        return $this->belongsTo(PreCleaningInput::class, 'nomor_job', 'nomor_job');
    }
    public function PreCleaningOutput()
    {
        return $this->hasMany(PreCleaningOutput::class, 'nomor_job', 'nomor_job');
    }
}
