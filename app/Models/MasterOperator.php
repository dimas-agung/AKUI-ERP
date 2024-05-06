<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOperator extends Model
{
    use HasFactory;
    protected $table = 'master_operators';

    protected $fillable = [
        'nama',
        'nip',
        'plant',
        'divisi',
        'departemen',
        'bagian',
        'workstation',
        'unit',
        'grade_operator',
        'nama_team_leader',
        'job',
        'status',
    ];
    public function PreCleaningOutput()
    {
        return $this->hasMany(PreCleaningOutput::class, 'operator_sikat_n_kompresor', 'nip');
    }
    public function PreWashOutput()
    {
        return $this->hasMany(PreWashOutput::class, 'operator_perendaman', 'nama');
    }
    public function Perusahaan()
    {
        return $this->hasMany(Perusahaan::class, 'plant', 'plant');
    }

    public function workstation()
    {
        return $this->belongsTo(Workstation::class, 'workstation', 'workstation');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit', 'unit');
    }
}
