<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJobMoulding extends Model
{
    use HasFactory;
    protected $table = 'master_job_mouldings';
    protected $fillable =
    [
        'jenis',
        'kategori_susut',
        'upah_operator',
        'pengurangan_harga',
        'harga_estimasi',
        'status',
        'user_created',
        'user_updated',
    ];
    public function MouldingPersiapan()
    {
        return $this->belongsTo(MouldingPersiapan::class, 'job_order', 'jenis');
    }
}
