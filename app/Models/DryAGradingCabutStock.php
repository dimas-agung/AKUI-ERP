<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAGradingCabutStock extends Model
{
    use HasFactory;
    protected $table = 'dry_a_grading_cabut_stocks';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'berat_kotor',
        'tujuan_kirim',
        'jenis_grading',
        'berat_1_grading',
        'pcs_1_grading',
        'berat_2_grading',
        'keterangan',
        'modal',
        'total_modal',
        'status',
    ];
    public function DryAOutputCabut()
    {
        return $this->hasMany(DryAOutputCabut::class, 'nomor_job', 'nomor_job');
    }
    public function DryAGradingCabut()
    {
        return $this->hasMany(DryAGradingCabut::class, 'nomor_job', 'nomor_job');
    }
}
