<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialAdjustment extends Model
{
    use HasFactory;
    protected $fillable = [
                'id_box_raw_material',
                'nomor_adjustment',
                'tanggal_adjustment',
                'nama_supplier',
                'berat_adjustment',
                'nomor_batch_adjustment',
                'nomor_batch',
                'jenis',
                'berat_saldo_awal',
                'berat_saldo_terakhir',
                'modal_saldo_terakhir',
                'berat_saldo_awal',
                'modal_saldo_awal',
                'total_modal_saldo_awal',
                'total_modal_saldo_terakhir',
                'keterangan',
                'user_created',
    ];
    public function PrmRawMaterialStock()
    {
        return $this->hasOne(PrmRawMaterialStock::class, 'id_box', 'id_box_raw_material');
    }
}
