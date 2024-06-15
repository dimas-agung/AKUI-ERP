<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcrKotorInput extends Model
{
    use HasFactory;
    protected $table = 'hcr_kotor_inputs';
    protected $fillable = [
        'tanggal_cabut',
        'jenis_hcr_kotor',
        'berat_hcr_kotor',
        'id_box_hcr_kotor',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
    public function MasterJenisHcrKotor()
    {
        return $this->belongsTo(MasterJenisHcrKotor::class, 'jenis', 'jenis_hcr_kotor');
    }
}
