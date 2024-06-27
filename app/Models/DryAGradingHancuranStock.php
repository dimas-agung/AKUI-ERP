<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAGradingHancuranStock extends Model
{
    use HasFactory;
    protected $table = 'dry_a_grading_hancuran_stocks';
    protected $fillable = [
        'jenis_grading',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'modal',
        'total_modal',
    ];
    public function DryAOutputHancuran()
    {
        return $this->hasMany(DryAOutputHancuran::class, 'jenis_grading', 'jenis_grading');
    }
}
