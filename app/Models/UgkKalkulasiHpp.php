<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UgkKalkulasiHpp extends Model
{
    use HasFactory;
    protected $table = 'ugk_kalkulasi_hpp';
    protected $fillable = [
        'nomor_grading',
        'nomor_batch',
        'nama_supplier',
        'jenis_adding',
        'berat_adding',
        'kadar_air',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'id_box',
        'modal',
        'total_modal',
        'fix_modal',
        'fix_total_modal',
        'kontribusi',
        'harga_estimasi',
        'total_harga',
        'nilai_laba_rugi',
        'nilai_prosentase_total_keuntungan',
        'nilai_setelah_dikurangi_keuntungan',
        'prosentase_harga_dan_gramasi',
        'selisih_laba_rugi_dalam_kg',
        'selisih_laba_rugi_per_gram',
        'hpp',
        'total_hpp',
        'keterangan',
        'datetime',
        'nip_admin',
    ];


    public function BiayaHpp()
    {
    	return $this->belongsTo(BiayaHpp::class);
    }
}
