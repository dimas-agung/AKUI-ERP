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
    public function PrmRawMaterialOutputHeader()
    {
    	return $this->hasMany(PrmRawMaterialOutputHeader::class, 'nomor_bstb', 'nomor_bstb');
    }
    public function StockTransitGradingKasar()
    {
        return $this->hasMany(StockTransitGradingKasar::class, 'nomor_bstb', 'nomor_bstb');
    }
}
