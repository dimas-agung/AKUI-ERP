<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouldingPersiapan extends Model
{
    use HasFactory;
    protected $table = 'moulding_persiapans';
    protected $fillable = [
        'id_box_grading_warna',
        'nomor_batch',
        'tujuan_kirim',
        'jenis_grading',
        'job_order',
        'berat_job',
        'pcs_job',
        'nomor_job',
        'biaya_produksi',
        'upah_operator',
        'modal_per_jenis',
        'total_modal_per_jenis',
        'modal_nomor_job',
        'total_modal_nomor_job',
        'user_created',
        'user_updated',
        'status',
    ];

    public function GradingWarnaStock()
    {
        return $this->belongsTo(GradingWarnaStock::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    }
    public function MasterJobMoulding()
    {
        return $this->belongsTo(MasterJobMoulding::class, 'jenis', 'job_order');
    }
    // public function RambangBasahStock()
    // {
    //     return $this->hasMany(RambangBasahStock::class, 'id_box_hcr_kotor', 'id_box_hcr_kotor');
    // }
}
