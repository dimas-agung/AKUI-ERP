<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransitRawMaterial extends Model
{
    use HasFactory;
    protected $table = 'stock_transit_raw_materials';
    protected $fillable = [
        'nomor_bstb',
        'nomor_batch',
        'id_box',
        'nama_supplier',
        'jenis',
        'nomor_nota_internal',
        'berat',
        'kadar_air',
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];

    public function PramRawMaterialOutputItems()
    {
        return $this->hasMany(PrmRawMaterialOutputItem::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function GradingKasarInput()
    {
        return $this->hasMany(GradingKasarInput::class, 'nomor_bstb', 'nomor_bstb');
    }
}
