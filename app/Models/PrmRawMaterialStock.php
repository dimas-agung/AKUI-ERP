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
        'nomor_nota_internal',
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
    public function PrmRawMaterialInput()
    {
        return $this->hasmany(PrmRawMaterialInput::class, 'nomor_nota_internal', 'created_at');
    }
    // public function PrmRawMaterialInput()
    // {
    //     return $this->belongsTo(PrmRawMaterialInput::class, 'created_at', 'nomor_nota_internal');
    // }
    public function PrmRawMaterialInputItem()
    {
        return $this->hasmany(PrmRawMaterialInputItem::class, 'id_box', 'id_box');
    }
    public function PrmRawMaterialStockHistory()
    {
        return $this->hasMany(PrmRawMaterialStockHistory::class, 'id_box', 'id_box');
    }
    public function PrmRawMaterialOutputItem()
    {
        return $this->hasMany(PrmRawMaterialOutputItem::class, 'id_box', 'id_box');
    }
}
