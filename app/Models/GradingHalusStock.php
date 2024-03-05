<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingHalusStock extends Model
{
    use HasFactory;
    protected $table = 'grading_halus_stocks';
    protected $fillable = [
        'unit',
        'id_box_grading_halus',
        'nomor_batch',
        'jenis',
        'berat_masuk',
        'pcs_masuk',
        'berat_keluar',
        'pcs_keluar',
        'sisa_berat',
        'sisa_pcs',
        'modal',
        'total_modal',
    ];
    public function GradingHalusInput()
    {
        return $this->belongsTo(GradingHalusInput::class, 'id_box_grading_halus', 'id_box_grading_halus');
    }
}
