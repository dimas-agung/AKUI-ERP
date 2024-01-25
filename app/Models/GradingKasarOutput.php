<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarOutput extends Model
{
    use HasFactory;
    protected $table ='grading_kasar_outputs';
    protected $fillable = [
        'nomor_bstb',
        'id_box_grading_kasar',
        'nomor_job',
        'nomor_batch',
        'nama_supplier',
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
    public function StockTransitGradingKasar()
    {
        return $this->hasMany(StockTransitGradingKasar::class, 'nomor_job', 'nomor_job');
    }
    public function GradingKasarStock()
    {
    	return $this->belongsTo(GradingKasarStock::class, 'id_box_grading_kasar', 'id_box_grading_kasar');
    }
}
