<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RambangKeringStock extends Model
{
    use HasFactory;
    protected $table = 'rambang_kering_stocks';
    protected $fillable =
    [
        'unit',
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
    ];
    public function RambangPengirimanWaste()
    {
        return $this->hasMany(RambangPengirimanWaste::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
}
