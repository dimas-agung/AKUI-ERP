<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarnaStock extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'grading_warna_stocks';
    protected $fillable = [
        'unit',
        'id_box_grading_warna',
        'nomor_batch',
        'tujuan_kirim',
        'jenis_grading',
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
    public function MouldingPersiapan()
    {
        return $this->hasMany(MouldingPersiapan::class, 'id_box_grading_warna', 'id_box_grading_warna');
    }
}
