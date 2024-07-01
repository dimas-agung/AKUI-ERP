<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RambangPengirimanWaste extends Model
{
    use HasFactory;
    protected $table = 'rambang_pengiriman_wastes';
    protected $fillable = [
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat',
        'keterangan',
        'nomor_bstb',
        'status',
        'user_created',
        'user_updated',
    ];
    public function RambangKeringStock()
    {
        return $this->hasMany(RambangKeringStock::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
}
