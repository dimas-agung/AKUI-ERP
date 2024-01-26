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
        // Create a new Unit or get an existing one
        $PrmRawOut = PrmRawMaterialOutputItem::factory()->create();
        return [
            'nomor_bstb' => $PrmRawOut->nomor_bstb,
            'nomor_batch' => $this->faker->unique()->randomNumber(5),
            'id_box' => $this->faker->unique()->randomNumber(3),
            'nama_supplier' => $this->faker->unique()->company,
            'jenis' => $this->faker->word,
            'nomor_nota_internal' => $this->faker->unique()->text(10),
            'berat' => $this->faker->randomFloat(2, 1, 100),
            'kadar_air' => $this->faker->randomFloat(2, 1, 100),
            'tujuan_kirim' => $this->faker->sentence,
            'letak_tujuan' => $this->faker->sentence,
            'inisial_tujuan' => $this->faker->word,
            'modal' => $this->faker->randomNumber(3),
            'total_modal' => $this->faker->randomNumber(6),
            'keterangan' => $this->faker->text(15),
            'user_created' => $this->faker->userName,
            'user_updated' => $this->faker->userName,
        ];
    }
}
