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
        'nama',
        'status',
    ];

    public function workstation()
    {
        return $this->belongsTo(Workstation::class);
    }

    public function biayahpp()
    {
        return $this->hasMany(BiayaHpp::class);
    }

    public function MasterJenisGrading()
    {
        return $this->hasmany(MasterJenisGrading::class);
    }
}
