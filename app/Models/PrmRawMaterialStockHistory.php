<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialStockHistory extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_stock_histories';
    protected $fillable = [
        'id_box',
        'doc_no',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'avg_kadar_air',
        'modal',
        'total_modal',
        'keterangan',
        'status',
        'user_created'
    ];
    // public function PrmRawMaterialStock()
    // {
    //     return $this->belongsTo(PrmRawMaterialStock::class);
    // }
    public function prmRawMaterialStock()
    {
        return $this->belongsTo(PrmRawMaterialStock::class, 'id_box', 'id_box');
    }
    public function PrmRawMaterialInputItem()
    {
        return $this->hasMany(PrmRawMaterialInputItem::class, 'id_box', 'id_box');
    }
    public function PrmRawMaterialOutputtItem()
    {
        return $this->hasOne(PrmRawMaterialOutputItem::class, 'id_box', 'id_box');
    }
}
