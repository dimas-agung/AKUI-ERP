<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRambangBasah extends Model
{
    use HasFactory;
    protected $table = 'stock_rambang_basahs';
    protected $fillable = [
        'unit',
        'id_box_hcr_kotor',
        'jenis_rambang',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
    ];
    public function InputRambangBasah()
    {
        return $this->belongsTo(InputRambangBasah::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
}
