<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAWasteInput extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'dry_a_waste_inputs';
    protected $fillable = [
        'tanggal_cabut',
        'jenis_waste',
        'berat',
        'pcs',
        'keterangan',
        'status',
        'harga_estimasi',
        'modal',
        'total_modal',
        'plant',
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
