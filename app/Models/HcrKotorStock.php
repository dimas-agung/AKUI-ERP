<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcrKotorStock extends Model
{
    use HasFactory;
    protected $table = 'hcr_kotor_stocks';
    protected $fillable = [
        'unit',
        'id_box_hcr_kotor',
        'tanggal_cabut',
        'jenis_hcr_kotor',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat'
    ];
    public function InputRambangBasah()
    {
        return $this->hasMany(RambangBasahInput::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
}
