<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTujuanKirimDryA extends Model
{
    use HasFactory;
    protected $table = 'master_tujuan_kirim_dry_a';
    protected $fillable = [
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'status',
        'user_created',
        'user_updated',
    ];
    public function DryAOutputHancuran()
    {
        return $this->hasMany(DryAOutputHancuran::class, 'tujuan_kirim', 'tujuan_kirim');
    }
}
