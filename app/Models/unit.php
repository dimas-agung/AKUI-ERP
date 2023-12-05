<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = [
        'datetime',
        'workstation_id',
        'nama',
        'status',
    ];

    public function workstation()
    {
    	return $this->belongsTo(Workstation::class, 'workstation_id', 'id');
    }
}
