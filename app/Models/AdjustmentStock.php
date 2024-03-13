<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentStock extends Model
{
    use HasFactory;
    protected $table = 'adjustment_stocks';
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
    public function AdjustmentInput()
    {
        return $this->hasMany(AdjustmentInput::class, 'nomor_adjustment', 'nomor_adjustment');
    }
}
