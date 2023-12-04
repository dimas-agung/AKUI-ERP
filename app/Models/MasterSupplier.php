<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSupplier extends Model
{
    use HasFactory;
    protected $table ='master_supplier_raw_material';

    protected $fillable = [
        'nama_supplier',
        'inisial_supplier',
        'status',
    ];
}