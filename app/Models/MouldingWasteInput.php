<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingWasteInput extends Model
{
    use HasFactory;
    protected $table = 'moulding_waste_inputs';
    protected $fillable = [
        'tanggal_moulding',
        'jenis_waste',
        'berat',
        'pcs',
        'id_box_wate_moulding',
        'keterangan',
        'status',
        'harga_estimasi',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function MasterJenisGradingWarna()
    {
    	return $this->belongsTo(MasterJenisGradingWarna::class, 'jenis', 'jenis_waste');
    }
}
