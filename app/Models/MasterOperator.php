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
        'job',
        'status',
    ];
    // public function PreCleaningOutput()
    // {
    //     return $this->hasMany(PreCleaningOutput::class, 'nip', 'operator_sikat_kompresor')
    //         ->orWhere('nip', 'operator_flek_poles')
    //         ->orWhere('nip', 'operator_flek_cutter');
    // }
    public function PreCleaningOutput()
    {
        return $this->hasMany(PreCleaningOutput::class, 'operator_sikat_n_kompresor', 'nip');
    }
}
