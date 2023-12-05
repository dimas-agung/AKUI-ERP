<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcPreCleanOutput extends Model
{
    use HasFactory;
    protected $table = 'upc_pre_cleaning_output';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'nama_supplier',
        'jenis',
        'berat',
        'pcs',
        'kadar_air',
        'operator_flek',
        'operator_sikat',
        'operator_oles',
        'operator_cuter',
        'berat_akhir',
        'kuningan',
        'sterofoam',
        'karat',
        'rontokan_flek',
        'rontokan_bahan',
        'ws_0_0_0',
        'susut',
        'nomor_bstb',
        'modal',
        'total_modal',
        'keterangan',
        'timestamp',
        'nip_admin',
    ];
}
