<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RambangBasahStock extends Model
{
    use HasFactory;
    protected $table = 'rambang_basah_stocks';
    protected $fillable = [
        'workstation',
        'unit',
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
    ];
    public function RambangKeringInput()
    {
        return $this->hasMany(RambangKeringInput::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
    public function RambangBasahInput()
    {
        return $this->hasMany(RambangBasahInput::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
    public function CabutHancuranPersiapan()
    {
        return $this->hasMany(CabutHancuranPersiapan::class, 'id_stock_hcr_kotor', 'id_box_hcr_kotor');
    }
}
