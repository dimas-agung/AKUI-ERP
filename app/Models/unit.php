<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'unit';
    protected $fillable = [
        'workstation_id',
        'perusahaan_id',
        'nama',
        'status',
    ];

    public function workstation()
    {
    	return $this->belongsTo(Workstation::class);
    }
    public function perusahaan()
    {
    	return $this->belongsTo(Perusahaan::class);
    }
    public function biayahpp()
    {
        return $this->hasMany(BiayaHpp::class);
    }
    public function PreGradingHalusInput()
    {
        return $this->hasMany(PreGradingHalusInput::class, 'nomor_bstb', 'nama');
    }
}
