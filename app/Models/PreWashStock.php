<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreWashStock extends Model
{
    use HasFactory;
    protected $table = 'pre_wash_stocks';
    protected $fillable = [
        'unit',
        'nomor_job',
        'nomor_batch',
        'status',
        'jenis_job',
        'berat_job',
        'pcs_job',
        'tujuan_kirim',
        'keterangan',
        'modal',
        'total_modal',
        'user_created',
        'user_updated',
    ];
    public function PreWashOutput()
    {
        return $this->hasMany(PreWashOutput::class, 'nomor_job', 'nomor_job');
    }
}
