<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialOutputHeader extends Model
{
    use HasFactory;
    protected $table = 'prm_raw_material_output_header';
    protected $fillable = [
        'doc_no',
        'nomor_bstb',
        'nomor_batch',
        'keterangan',
        'user_created',
        'user_updated',
    ];

}