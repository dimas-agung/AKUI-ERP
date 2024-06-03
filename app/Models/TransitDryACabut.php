<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitDryACabut extends Model
{
    use HasFactory;
    protected $table = 'transit_dry_a_cabuts';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_bstb',
        'nomor_batch',
        'tujuan_kirim',
        'keterangan',
        'berat_kotor',
        'jenis_grading',
        'berat_1_grading',
        'pcs_1_grading',
        'berat_2_grading',
        'modal',
        'total_modal',
        'status'
    ];
    public function DryAOutputCabut()
    {
        return $this->belongsTo(DryAOutputCabut::class, 'nomor_job', 'nomor_job');
    }
}
