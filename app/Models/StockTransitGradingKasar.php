<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransitGradingKasar extends Model
{
    use HasFactory;
    protected $table ='stock_transit_grading_kasars';
    protected $fillable = [
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'nomor_batch',
        'nama_supplier',
        'nomor_nota_internal',
        'id_box_raw_material',
        'jenis_raw_material',
        'jenis_grading',
        'berat_keluar',
        'pcs_keluar',
        'avg_kadar_air',
        'tujuan_kirim',
        'nomor_grading',
        'modal',
        'total_modal',
        'biaya_produksi',
        'fix_total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];

    public function GradingKasarOutput()
    {
        return $this->hasOne(GradingKasarOutput::class, 'nomor_job', 'nomor_job');
    }
    public function PreCleaningInput()
    {
        return $this->hasMany(PreCleaningInput::class, 'nomor_job', 'nomor_job');
    }
}
