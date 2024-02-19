<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPreCleaningStock extends Model
{
    use HasFactory;
    protected $table = 'transit_pre_cleaning_stocks';
    protected $fillable = [
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'nama_supplier',
        'nomor_batch',
        'nomor_nota_internal',
        'id_box_raw_material',
        'jenis_raw_material',
        'jenis_kirim',
        'berat_kirim',
        'pcs_kirim',
        'kadar_air',
        'tujuan_kirim',
        'nomor_grading',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];
    public function PreCleaningOutput()
    {
        return $this->hasMany(PreCleaningOutput::class, 'nomor_job', 'nomor_job');
    }
    public function PreGradingHalusInput()
    {
        return $this->hasMany(PreGradingHalusInput::class, 'nomor_bstb', 'nomor_bstb');
    }
}
