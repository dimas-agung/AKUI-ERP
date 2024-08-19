<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalGrading extends Model
{
    use HasFactory;
    const   STATUS_NON_AKTIF = 0;
    const   STATUS_AKTIF = 1;
    protected $table = 'final_gradings';
    protected $fillable = [
        'nomor_job',
        'nomor_batch',
        'tujuan_kirim',
        'job_order',
        'berat_job',
        'pcs_job',
        'upah_operator',
        'nama_operator',
        'nip_operator',
        'grade_operator',
        'nama_team_leader',
        'jenis_grading',
        'berat_grading',
        'pcs_grading',
        'rework',
        'nomor_job_rework',
        'kategori_susut',
        'susut_depan',
        'susut_belakang',
        'modal',
        'total_modal',
        'biaya_produksi',
        'kontribusi',
        'harga_estimasi',
        'total_harga',
        'nilai_laba_rugi',
        'nilai_prosentase_total_keuntungan',
        'nilai_dikurangi_keuntungan',
        'prosentase_harga_gramasi',
        'selisih_laba_rugi_kg',
        'selisih_laba_rugi_per_gram',
        'hpp',
        'total_hpp',
        'fix_hpp',
        'fix_total_hpp',
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
