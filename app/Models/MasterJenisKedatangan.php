<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisKedatangan extends Model
{
    use HasFactory;
    const STATUS_AKTIF = 1;
    const STATUS_NON_AKTIF = 0;
    protected $table = 'master_jenis_kedatangans';
    protected $fillable = [
        'jenis',
        'kategori_susut',
        'upah_operator',
        'pengurangan_harga',
        'harga_estimasi',
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
