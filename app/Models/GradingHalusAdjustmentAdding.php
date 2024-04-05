<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHalusAdjustmentAdding extends Model
{
    use HasFactory;
    protected $table = 'grading_halus_adjustment_addings';
    protected $fillable = [
        'id_box_grading_halus',
        'nomor_batch',
        'jenis_adding',
        'berat_adding',
        'pcs_adding',
        'keterangan',
        'modal',
        'total_modal',
        'nomor_adjustment',
        'user_created',
        'user_updated',
    ];
    public function GradingHalusStock()
    {
        return $this->hasMany(GradingHalusStock::class, 'id_box_grading_halus', 'id_box_grading_halus');
    }
    public function GradingHalusAdjustmentStock()
    {
        return $this->hasMany(GradingHalusAdjustmentStock::class, 'nomor_adjustment', 'nomor_adjustment');
    }
}
