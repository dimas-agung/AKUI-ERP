<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisGrading extends Model
{
    use HasFactory;
    protected $table = '';
    protected $fillable = [
        'nama',
        'unit_id',
        'status',
        'user_created',
        'user_updated',
    ];

    public function Unit()
    {
        return $this->hasmany(Unit::class);
    }
}
