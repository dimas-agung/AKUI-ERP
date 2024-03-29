<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingKasarStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_no',
        'id_box_grading_kasar',
        'nomor_batch',
        'nama_supplier',
        'nomor_nota_internal',
        'jenis_raw_material',
        'jenis_grading',
        'id_box_raw_material',
        'berat_masuk',
        'berat_keluar',
        'pcs_masuk',
        'pcs_keluar',
        'avg_kadar_air',
        'nomor_grading',
        'modal',
        'total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];
    public function GradingKasarHasil()
    {
<<<<<<< HEAD
        return $this->hasMany(GradingKasarHasil::class, 'id_box_grading_kasar', 'id_box_grading_kasar');
    }
    public function GradingKasarOutput()
    {
        return $this->hasMany(GradingKasarOutput::class, 'id_box_grading_kasar', 'id_box_grading_kasar');
    }
}

=======
        return $this->hasmany(GradingKasarHasil::class);
    }
}
>>>>>>> dev-helmi
