<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTujuanKirimGradingHalus extends Model
{
    use HasFactory;
    protected $table = 'master_tujuan_kirim_grading_haluses';
    protected $fillable = [
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'status',
    ];

        public function GradingHalusOutput()
    {
        return $this->hasMany(GradingHalusOutput::class, 'tujuan_kirim', 'tujuan_kirim');
    }
}
