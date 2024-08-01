<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarnaPenerimaanKedatangan extends Model
{
    use HasFactory;
    const STATUS_AKTIF = 1;
    const STATUS_NON_AKTIF = 0;
    protected $table = 'grading_warna_penerimaan_kedatangans';
    protected $fillable = [
        'nomor_job',
        'nomor_bstb',
        'nomor_batch',
        'tujuan_kirim',
        'keterangan',
        'berat_kotor',
        'jenis_grading',
        'berat_1_grading',
        'pcs_1_grading',
        'berat_2_grading',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
        'status',
    ];

    public function can_delete()
    {
        if ($this->status ==  self::STATUS_AKTIF) {
            return true;
        }
        return false;
    }
}
