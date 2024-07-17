<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteInput extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'moulding_waste_inputs';
    protected $fillable = [
        'tanggal_moulding',
        'jenis_waste',
        'berat',
        'pcs',
        'id_box_waste_moulding',
        'keterangan',
        'harga_estimasi',
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
    public function MasterJenisGradingWarna()
    {
    	return $this->belongsTo(MasterJenisGradingWarna::class, 'jenis', 'jenis_waste');
    }
}
