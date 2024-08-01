<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBatch extends Model
{
    use HasFactory;
    const STATUS_AKTIF = 1;
    const STATUS_NON_AKTIF = 0;
    protected $table = 'master_batches';
    protected $fillable = [
        'nomor_batch',
        'user_created',
        'user_updated',
        'status',
    ];

    public function can_delete()
    {
        if ($this->status ==  self::STATUS_NON_AKTIF) {
            return true;
        }
        return false;
    }
}
