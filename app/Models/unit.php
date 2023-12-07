<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = [
        'datetime',
        'workstation_id',
        'nama',
        'status',
    ];

    public function Workstation()
    {
    	return $this->belongsTo(Workstation::class);
    }
}
