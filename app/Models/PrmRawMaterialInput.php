<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialInput extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_inputs';
    protected $fillable = [
        'doc_no',
        'nomor_po',
        'nomor_batch',
        'nomor_nota_supplier',
        'nomor_nota_internal',
        'nama_supplier',
        'keterangan',
        'user_created',
        'user_updated'
    ];

    public function MasterSupplierRawMaterial()
    {
        return $this->belongsTo(MasterSupplierRawMaterial::class, 'nama_supplier', 'nama_supplier');
    }
    public function PrmRawMaterialInputItem()
    {
        return $this->belongsTo(PrmRawMaterialInputItem::class, 'doc_no', 'doc_no');
    }
}