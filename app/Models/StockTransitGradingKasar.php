<?php

namespace App\Models;

use App\Models\Scopes\AvaillableBeratKeluarStockScope;
use App\Models\Scopes\AvaillableStockScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransitGradingKasar extends Model
{
    use HasFactory;
    protected $table ='stock_transit_grading_kasars';
    protected $fillable = [
        'nomor_job',
        'id_box_grading_kasar',
        'nomor_bstb',
        'nomor_batch',
        'nama_supplier',
        'nomor_nota_internal',
        'id_box_raw_material',
        'jenis_raw_material',
        'jenis_grading',
        'berat_keluar',
        'pcs_keluar',
        'avg_kadar_air',
        'tujuan_kirim',
        'nomor_grading',
        'modal',
        'total_modal',
        'biaya_produksi',
        'fix_total_modal',
        'keterangan',
        'user_created',
        'user_updated',
    ];
    protected static function booted(): void
    {
        // call global scope
        // static::addGlobalScope(new AvaillableBeratKeluarStockScope);
    }

    public function GradingKasarOutput()
    {
        return $this->hasOne(GradingKasarOutput::class, 'nomor_job', 'nomor_job');
    }
    public function PreCleaningInput()
    {
        return $this->hasMany(PreCleaningInput::class, 'nomor_job', 'nomor_job');
    }
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->berat_keluar <> 0 ? 1:0,
            // set:  fn () => $this->berat_keluar <> 0 ? 1:0,
        );
    }
    public function getFullNameAttribute()
    {
        return "{$this->berat_keluar}1121";
    }
}