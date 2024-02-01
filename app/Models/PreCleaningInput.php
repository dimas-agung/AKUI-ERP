<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreCleaningInput extends Model
{
    use HasFactory;
    protected $table = 'pre_cleaning_inputs';
    protected $fillable = [
        'doc_no',
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'nomor_batch',
        'nama_supplier',
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
    public function StockTransitGradingKasar()
    {
        return $this->belongsTo(StockTransitGradingKasar::class, 'nomor_job', 'nomor_job');
    }
    public function preCleaningStock()
    {
        return $this->hasMany(PreCleaningStock::class, 'nomor_job', 'nomor_job');
    }
}
