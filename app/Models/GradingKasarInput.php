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
        'jenis',
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

    // public function StockTransitGradigKasar()
    // {
    //     return $this->hasMany(StockTransitGradingKasar::class, 'nomor_bstb', 'nomor_bstb');
    // }
        // Mendefinisikan hubungan dengan model StockTransitGradingKasar
        public function stockTransitGradingKasar()
        {
            return $this->belongsTo(StockTransitGradingKasar::class, 'nomor_bstb', 'nomor_bstb');
        }
        public function PrmRawMaterialInput()
        {
            return $this->belongsTo(PrmRawMaterialInput::class, 'doc_no', 'doc_no');
        }
}
