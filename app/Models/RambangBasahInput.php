<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RambangBasahInput extends Model
{
    use HasFactory;
    protected $table = 'rambang_basah_inputs';
    protected $fillable = [
        'id_box_hcr_kotor',
        'tanggal_cabut',
        'jenis_hcr_kotor',
        'berat_hcr_kotor',
        'jenis_rambang',
        'berat',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
    public function HcrKotorStock()
    {
        return $this->belongsTo(HcrKotorStock::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
    public function MasterJenisRambang()
    {
        return $this->belongsTo(MasterJenisGradingHalus::class, 'jenis', 'jenis_rambang');
    }
    public function RambangBasahStock()
    {
        return $this->hasMany(RambangBasahStock::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
}
