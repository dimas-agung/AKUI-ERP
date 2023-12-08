<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSupplierRawMaterial extends Model
{
    use HasFactory;
    protected $table = 'master_supplier_raw_materials';
    protected $fillable = [
        'nama_supplier',
        'inisial_supplier',
        'status',
    ];
}
