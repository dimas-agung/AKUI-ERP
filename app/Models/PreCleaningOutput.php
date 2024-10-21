<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreCleaningOutput extends Model
{
    use HasFactory;
    protected $table = 'pre_cleaning_outputs';
    protected $fillable = [
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'id_box_raw_material',
        'nomor_batch',
        'nomor_nota_internal',
        'nama_supplier',
        'jenis_raw_material',
        'kadar_air',
        'jenis_kirim',
        'berat_kirim',
        'pcs_kirim',
        'tujuan_kirim',
        'modal',
        'total_modal',
        'operator_sikat_n_kompresor',
        'operator_flek_n_poles',
        'operator_cutter',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'susut',
        'keterangan',
        'nomor_grading',
        'user_created',
        'user_updated',
        'status'
    ];

    public function PreCleaningStock()
    {
        return $this->belongsTo(PreCleaningStock::class, 'nomor_job', 'nomor_job');
    }
    public function MasterOperator()
    {
        return $this->hasMany(MasterOperator::class, 'nip', 'operator_sikat_n_kompresor');
    }

    public function TransitPreCleaningStock()
    {
        return $this->hasMany(TransitPreCleaningStock::class, 'nomor_job', 'nomor_job');
    }
}
