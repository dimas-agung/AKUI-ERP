<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreCleaningOutput extends Model
{
    use HasFactory;
    protected $table = 'pre_cleaning_outputs';
    protected $fillable = [
        'doc_no',
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'nomor_batch',
        'nama_supplier',
        'nomor_nota_internal',
        'id_box_raw_material',
        'jenis_raw_material',
        'jenis_kirim',
        'berat_kirim',
        'pcs_kirim',
        'modal',
        'total_modal',
        'operator_sikat_kompresor',
        'operator_flek_poles',
        'operator_flek_cutter',
        'kuningan',
        'sterofoam',
        'karat',
        'rontokan_fisik',
        'rontokan_bahan',
        'rontokan_serabut',
        'ws_0_0_0',
        'berat_pre_cleaning',
        'pcs_pre_cleaning',
        'susut',
        'user_created',
        'user_updated',
    ];

    public function PreCleaningStock()
    {
        return $this->belongsTo(PreCleaningStock::class, 'nomor_job', 'nomor_job');
    }
    public function MasterOperator()
    {
        return $this->hasMany(MasterOperator::class, 'nip', 'operator_sikat_kompresor');
    }

    public function TransitPreCleaningStock()
    {
        return $this->hasMany(TransitPreCleaningStock::class, 'nomor_job', 'nomor_job');
    }
}
