<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentAdding extends Model
{
    use HasFactory;
    protected $table = 'adjustment_addings';
    protected $fillable = [
        'id_box_grading_halus',
        'nomor_batch',
        'jenis_adding',
        'berat_adding',
        'pcs_adding',
        'keterangan',
        'modal',
        'total_modal',
        'nomor_adjustment',
        'user_created',
        'user_updated',
    ];
}