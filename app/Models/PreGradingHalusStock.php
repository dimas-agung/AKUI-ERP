<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreGradingHalusStock extends Model
{
    use HasFactory;
    protected $table = 'pre_grading_halus_stocks';
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
        'berat_kirim',
        'pcs_kirim',
        'jenis_pre_cleaning',
        'berat_pre_cleaning',
        'pcs_pre_cleaning',
        'tujuan_kirim',
        'modal',
        'total_modal',
        'status'
    ];
    public function PreGradingHalusInput()
    {
        return $this->hasMany(PreGradingHalusInput::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function PreGradingHalusAdding()
    {
        return $this->hasMany(PreGradingHalusAdding::class, 'nomor_job', 'nomor_job');
    }
}
