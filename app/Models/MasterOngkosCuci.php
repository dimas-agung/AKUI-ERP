<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOngkosCuci extends Model
{
    use HasFactory;
    protected $table = 'master_ongkos_cucis';
    protected $fillable = [
        'unit',
        'jenis_bulu',
        'biaya_per_gram',
        'status',
        'user_created',
        'user_updated',
    ];
}
