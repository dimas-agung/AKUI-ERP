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
        'perusahaan_id',
        'divisi',
        'departemen',
        'bagian',
        'workstation_id',
        'unit_id',
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
        return $this->belongsTo(Perusahaan::class);
    }

    public function workstation()
    {
        return $this->belongsTo(Workstation::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
