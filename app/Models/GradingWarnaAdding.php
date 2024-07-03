<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingWarnaAdding extends Model
{
    use HasFactory;
    const STATUS_NON_AKTIF = 0;
    const STATUS_AKTIF = 1;
    protected $table = 'grading_warna_addings';
    protected $fillable = [
        'nomor_job',
        'nomor_bstb',
        'nomor_batch',
        'tujuan_kirim',
        'berat_kotor',
        'jenis_grading',
        'berat_1_grading',
        'pcs_1_grading',
        'berat_2_grading',
        'modal',
        'total_modal',
        'nomor_lot',
        'berat_kotor_adding',
        'prosentase_susut',
        'keterangan',
        'status',
        'user_created',
        'user_updated',
    ];
    public function can_delete()
    {
        if ($this->status == self::STATUS_AKTIF) {
            return true;
        }
        return false;
    }
    public function GradingWarnaPenerimaanStock()
    {
        return $this->hasMany(GradingWarnaPenerimaanStock::class, 'nomor_job', 'nomor_job');
    }
    public function GradingWarnaAddingStock()
    {
        return $this->hasMany(GradingWarnaAddingStock::class, 'nomor_lot', 'nomor_lot');
    }
}
