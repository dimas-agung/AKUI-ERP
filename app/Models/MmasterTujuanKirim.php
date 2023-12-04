<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MmasterTujuanKirim extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan_kirim',
        'letak_kirim',
        'inisial_kirim',
        'status',
    ];
}
