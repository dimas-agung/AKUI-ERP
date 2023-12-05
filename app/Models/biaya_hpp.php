<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biaya_hpp extends Model
{
    use HasFactory;
    protected $table = 'biaya_hpp';
    protected $fillable = [
        'datetime',
        'unit_id',
        'jenis_biaya',
        'biaya_per_gram',
        'status',
    ];

    public function unit()  {
    	return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
