<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialStock extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_stocks';
    protected $fillable = [
        'id_box',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'avg_kadar_air',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated'
    ];
    public function PrmRawMaterialInputItem()
    {
        return $this->hasOne(PrmRawMaterialInputItem::class, 'id_box', 'id_box');
    }
    public function PrmRawMaterialStockHistory()
    {
        return $this->hasMany(PrmRawMaterialStockHistory::class);
    }
    // public function PrmRawMaterialOutputItem()
    // {
    //     return $this->hasMany(PrmRawMaterialOutputItem::class);
    // }
}