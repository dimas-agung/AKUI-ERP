<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitDryAHancuran extends Model
{
    use HasFactory;
    protected $table = 'transit_dry_a_hancurans';
    protected $fillable = [
        'unit',
        'jenis_grading',
        'berat_job',
        'nomor_job',
        'nomor_bstb',
        'tujuan_kirim',
        'status',
    ];
    public function DryAOutputHancuran()
    {
        return $this->belongsTo(DryAOutputHancuran::class, 'jenis_grading', 'jenis_grading');
    }
}
