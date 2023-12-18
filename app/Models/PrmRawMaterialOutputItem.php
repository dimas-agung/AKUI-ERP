<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrmRawMaterialOutputItem extends Model
{
    use HasFactory;

    protected $table = 'prm_raw_material_output_items';

    protected $fillable = [
        'doc_no',
        'nomor_bstb',
        'nomor_batch',
        'id_box',
        'nama_supplier',
        'jenis',
        'berat',
        'kadar_air',
        'tujuan_kirim',
        'letak_tujuan',
<<<<<<< HEAD

        'inisial_tujuan',

=======
>>>>>>> parent of acaa9aa (menambahkan menu purching exam baru)
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated'
    ];


    public function PrmRawMaterialOutputHeader()
    {
    	return $this->belongsTo(PrmRawMaterialOutputHeader::class);
    }
}
