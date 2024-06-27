<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAOutputHancuran extends Model
{
    use HasFactory;
    protected $table = 'dry_a_output_hancurans';
    protected $fillable = [
        'jenis_grading',
        'berat_job',
        'nomor_job',
        'nomor_bstb',
        'tujuan_kirim',
        'status',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function DryAGradingHancuranStock()
    {
        return $this->belongsTo(DryAGradingHancuranStock::class, 'jenis_grading', 'jenis_grading');
    }
    public function TransitDryAHancuran()
    {
        return $this->hasMany(TransitDryAHancuran::class, 'jenis_grading', 'jenis_grading');
    }
}
