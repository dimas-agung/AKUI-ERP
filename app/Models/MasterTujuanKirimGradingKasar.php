<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTujuanKirimGradingKasar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'status',
    ];
}
