<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarInput extends Model
{
    use HasFactory;
    protected $table = 'grading_kasar_inputs';
    protected $fillable = [
        'doc_no',
        'nomor_bstb',
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis_raw_material',
        'nomor_nota_internal',
        'berat',
        'kadar_air',
        'nomor_grading',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];

    public function StockTransitRawMaterial()
    {
        return $this->belongsTo(StockTransitRawMaterial::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function GradingKasarHasil()
    {
        return $this->belongsTo(GradingKasarHasil::class, 'nomor_grading', 'nomor_grading');
    }
}
