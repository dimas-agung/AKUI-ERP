<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitPreCleaningStock extends Model
{
    use HasFactory;
    protected $table = 'transit_pre_cleaning_stocks';
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
        'tujuan_kirim',
        'modal',
        'total_modal',
        'sisa_berat',
        'keterangan',
        'nomor_grading',
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
