<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteOutput extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'moulding_waste_outputs';
    protected $fillable = [
        'asal_stock',
        'id_box_waste_moulding',
        'jenis',
        'berat',
        'pcs',
        'tujuan_kirim',
        'nomor_job',
        'nomor_bstb',
        'keterangan',
        'modal',
        'total_modal',
        'status',
        'user_created',
        'user_updated',
    ];
    public function can_delete()
    {
        if ($this->status == self::STATUS_AKTIF) {
            return true;
        }
        return false;
    }
}
