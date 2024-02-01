<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisRawMaterial extends Model
{
    use HasFactory;
    protected $table = 'master_jenis_raw_materials';
    protected $fillable = [
        'jenis',
        'kategori_susut',
        'upah_operator',
        'pengurangan_harga',
        'harga_estimasi',
        'status',
    ];
    public function PrmRawMaterialInputItem()
    {
        return $this->hasMany(PrmRawMaterialInputItem::class, 'jenis', 'jenis');
    }
}
