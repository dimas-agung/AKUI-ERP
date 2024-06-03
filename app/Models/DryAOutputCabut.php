<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAOutputCabut extends Model
{
    use HasFactory;
    protected $table = 'dry_a_output_cabuts';
    protected $fillable = [
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
        'user_created',
        'user_updated',
        'status',
    ];
    public function DryAGradingCabutStock()
    {
        return $this->belongsTo(DryAGradingCabutStock::class, 'nomor_job', 'nomor_job');
    }
    public function TransitDryACabut()
    {
        return $this->hasMany(TransitDryACabut::class, 'nomor_job', 'nomor_job');
    }
}
