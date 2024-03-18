<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHalusAdjustmentStock extends Model
{
    use HasFactory;
    protected $table = 'grading_halus_adjustment_stocks';
    protected $fillable = [
        'unit',
        'nomor_adjustment',
        'nomor_batch',
        'berat_adding',
        'pcs_adding',
        'modal',
        'total_modal',
        'status',
    ];
    public function GradingHalusAdjustmentAdding()
    {
        return $this->hasMany(GradingHalusAdjustmentAdding::class, 'nomor_adjustment', 'nomor_adjustment');
    }
    public function GradingHalusAdjustmentInput()
    {
        return $this->hasMany(GradingHalusAdjustmentInput::class, 'nomor_adjustment', 'nomor_adjustment');
    }
}
