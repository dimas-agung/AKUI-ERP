<?php

namespace Database\Factories;

use App\Models\PrmRawMaterialOutputItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\StockTransitRawMaterial;

class StockTransitRawMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get existing PrmRawMaterialOutputItem or create a new one
        $PrmRawOut = PrmRawMaterialOutputItem::inRandomOrder()->first() ?? PrmRawMaterialOutputItem::factory()->create();

        return [
            'nomor_bstb'    => $PrmRawOut->nomor_bstb,
            'nomor_batch'   => $PrmRawOut->nomor_batch,
            'id_box'        => $PrmRawOut->id_box,
            'nama_supplier' => $PrmRawOut->nama_supplier,
            'jenis'         =>$PrmRawOut->jenis,
            'nomor_nota_internal' => $this->faker->unique()->randomNumber(7),
            'berat'         => $PrmRawOut->berat,
            'kadar_air'     => $PrmRawOut->kadar_air,
            'tujuan_kirim'  => $PrmRawOut->tujuan_kirim,
            'letak_tujuan'  => $PrmRawOut->letak_tujuan,
            'inisial_tujuan' =>$PrmRawOut->inisial_tujuan,
            'modal' => $PrmRawOut->modal,
            'total_modal' => $PrmRawOut->total_modal,
            'keterangan' => $PrmRawOut->keterangan_item,
            'user_created' => $this->faker->userName,
            'user_updated' => $this->faker->userName,
        ];
    }
}
