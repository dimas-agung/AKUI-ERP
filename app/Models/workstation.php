<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workstation extends Model
{
    use HasFactory;
    protected $fillable = [
        'datetime',
        'workstation_id',
        'nama',
        'status',
    ];
}
