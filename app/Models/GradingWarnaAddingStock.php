<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarnaAddingStock extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'grading_warna_adding_stocks';
    protected $fillable = [
        'unit',
        'nomor_lot',
        'nomor_batch',
        'tujuan_kirim',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'pcs_masuk',
        'pcs_keluar',
        'sisa_pcs',
        'modal',
        'total_modal',
        'status',
    ];
    public function GradingWarnaAdding()
    {
        return $this->hasMany(GradingWarnaAdding::class, 'nomor_lot', 'nomor_lot');
    }
    public function GradingWarna()
    {
        return $this->hasMany(GradingWarna::class, 'nomor_lot', 'nomor_lot');
    }
}
