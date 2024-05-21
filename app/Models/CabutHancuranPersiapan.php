<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabutHancuranPersiapan extends Model
{
    use HasFactory;
    protected $table = 'cabut_hancuran_persiapans';
    protected $fillable = [
        'id_stock_hcr_kotor',
        'jenis_rambang',
        'berat',
        'nomor_job',
        'upah_operator',
        'status',
        'user_created',
        'user_updated',
    ];
    public function StockRambangBasah()
    {
        return $this->belongsTo(StockRambangBasah::class, 'id_box_hcr_kotor', 'id_stock_hcr_kotor');
    }
}
