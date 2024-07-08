<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTujuanKirimMoulding extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'master_tujuan_kirim_mouldings';
    protected $fillable = [
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'status',
        'user_created',
        'user_updated',
    ];
}
