<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreGradingHalusAddingStock extends Model
{
    use HasFactory;
    protected $table = 'pre_grading_halus_adding_stocks';
    protected $fillable = [
        'unit',
        'nomor_grading',
        'id_box_grading_kasar',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'jenis_raw_material',
        'kadar_air',
        'berat_adding',
        'pcs_adding',
        'modal',
        'total_modal',
        'status_stock',
    ];
    public function GradingHalusInput()
    {
        return $this->hasMany(GradingHalusInput::class, 'nomor_grading', 'nomor_grading');
    }
}
