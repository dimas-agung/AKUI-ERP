<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTujuanKirimWaste extends Model
{
    use HasFactory;
    protected $table = 'master_tujuan_kirim_wastes';
    protected $fillable = [
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'status',
        'user_created',
        'user_updated',
    ];
}
