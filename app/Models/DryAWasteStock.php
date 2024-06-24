<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DryAWasteStock extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'dry_a_waste_stocks';
    protected $fillable = [
        'unit',
        'jenis_waste',
        'berat_masuk',
        'berat_keluar',
        'sisa_berat',
        'pcs_masuk',
        'pcs_keluar',
        'sisa_pcs',
        'status',
    ];
    public function DryAWasteOutput()
    {
        return $this->hasMany(DryAWasteOutput::class, 'jenis_waste', 'jenis_waste');
    }
}
