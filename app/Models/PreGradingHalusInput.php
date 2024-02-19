<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreGradingHalusInput extends Model
{
    use HasFactory;
    protected $table = 'pre_grading_halus_inputs';
    protected $fillable = [
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'id_box_raw_material',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'status',
        'jenis_raw_material',
        'kadar_air',
        'jenis_kirim',
        'berat_kirim',
        'pcs_kirim',
        'tujuan_kirim',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];

    public function TransitPreCleaningStock()
    {
        return $this->belongsTo(TransitPreCleaningStock::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function Unit()
    {
        return $this->belongsTo(Unit::class, 'nama', 'nomor_bstb');
    }
    public function PreGradingHalusStock()
    {
        return $this->hasMany(PreGradingHalusStock::class, 'nomor_job', 'nomor_job');
    }
}
