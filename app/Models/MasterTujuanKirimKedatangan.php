<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTujuanKirimKedatangan extends Model
{
    use HasFactory;
    const STATUS_AKTIF = 1;
    const STATUS_NON_AKTIF = 0;
    protected $table = 'master_tujuan_kirim_kedatangans';
    protected $fillable = [
        'tujuan_kirim',
        'letak_tujuan',
        'inisial_tujuan',
        'status',
        'user_created',
        'user_updated',
    ];
    public function can_delete()
    {
        if ($this->status ==  self::STATUS_NON_AKTIF) {
            return true;
        }
        return false;
    }
}
