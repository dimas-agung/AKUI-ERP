<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaans';
    protected $fillable = [
        'nama',
        'plant',
        'status',
    ];
    public function PreGradingHalusAdding()
    {
        return $this->hasMany(PreGradingHalusAdding::class, 'nama', 'nomor_job');
    }
    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
    public function workstation()
    {
        return $this->hasMany(Workstation::class);
    }
}
