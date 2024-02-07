<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialOutputItem extends Model
{
    use HasFactory;

    protected $table = 'prm_raw_material_output_items';

    protected $fillable = [
        'doc_no',
        'nomor_bstb',
        'nomor_batch',
        'id_box',
        'nama_supplier',
        'status',
        'jenis',
        'berat',
        'kadar_air',
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'modal',
        'total_modal',
        'keterangan_item',
        'user_created',
        'user_updated'
    ];

    public function PrmRawMaterialStock()
    {
    	return $this->belongsTo(PrmRawMaterialStock::class, 'id_box', 'id_box');
    }
    public function PrmRawMaterialStockHistory()
    {
        return $this->hasMany(PrmRawMaterialStockHistory::class, 'id_box', 'id_box');
    }
    public function StockTransitRawMaterial()
    {
        return $this->hasMany(StockTransitRawMaterial::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function GradingKasarInput()
    {
        return $this->hasMany(GradingKasarInput::class, 'nomor_bstb', 'nomor_bstb');
    }
}
