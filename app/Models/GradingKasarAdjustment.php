<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarAdjustment extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_adjustment',
        'nomor_batch_adjustment',
        'nomor_batch',
        'tanggal_adjustment',
        'id_box_grading_kasar',
        'id_box_raw_material',
        'nama_supplier',
        'jenis_raw_material',
        'jenis_grading',
        'kadar_air',
        'berat_adjustment',
        'berat_saldo_awal',
        'berat_saldo_terakhir',
        'modal_saldo_terakhir',
        'total_modal_saldo_terakhir',
        'berat_saldo_awal',
        'modal_saldo_awal',
        'total_modal_saldo_awal',
        'keterangan',
        'user_created',
        'status'
    ];
    public function PrmRawMaterialStock()
    {
        return $this->hasOne(GradingKasarStock::class, 'id_box_grading_kasar', 'id_box_grading_kasar');
    }
}
