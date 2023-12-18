<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialOutputHeader extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $table = 'prm_raw_material_output_headers';

=======
    protected $table = 'pram_raw_material_output_headers';
>>>>>>> parent of acaa9aa (menambahkan menu purching exam baru)
    protected $fillable = [
        'doc_no',
        'nomor_bstb',
        'nomor_batch',
        'keterangan',
        'user_created',

        'user_updated',
    ];

    public function StockTransitGradingKasar()
    {
    	return $this->belongsTo(StockTransitGradingKasar::class);
    }

    public function PrmRawMaterialOutputItem()
    {
        return $this->hasMany(PrmRawMaterialOutputItem::class);
    }
}
