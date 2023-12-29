<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialInputItem extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_input_items';
    protected $fillable = [
        'doc_no',
        'jenis',
        'berat_nota',
        'berat_kotor',
        'berat_bersih',
        'selisih_berat',
        'kadar_air',
        'id_box',
        'harga_nota',
        'total_harga_nota',
        'harga_deal',
        'keterangan',
        'user_created',
        'user_updated'
    ];
    public function PrmRawMaterialInput()
    {
        return $this->belongsTo(PrmRawMaterialInput::class, 'doc_no', 'doc_no');
    }
    public function PrmRawMaterialStock()
    {
        return $this->hasOne(PrmRawMaterialStock::class, 'id_box', 'id_box');
    }
    public function MasterJenisRawMaterial()
    {
        return $this->belongsTo(MasterJenisRawMaterial::class);
    }
    // public function PrmRawMaterialStockHistory()
    // {
    //     return $this->hasMany(PrmRawMaterialStockHistory::class, 'id_box', 'id_box');
    // }
    public function PrmRawMaterialStockHistory()
    {
        return $this->hasMany(PrmRawMaterialStockHistory::class, 'id_box', 'id_box');
    }
}
