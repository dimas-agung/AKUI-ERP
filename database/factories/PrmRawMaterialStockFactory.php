<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\PrmRawMaterialStock;

class PrmRawMaterialStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_box' => $this->faker->unique()->randomNumber(3),
            'nomor_batch' => $this->faker->unique()->randomNumber(5),
            'nama_supplier' => $this->faker->unique()->company,
            'jenis' => $this->faker->word,
            'nomor_nota_internal' => $this->faker->unique()->text(10),
            'berat_masuk' => $this->faker->randomFloat(2, 1, 100),
            'berat_keluar' => $this->faker->randomFloat(2, 1, 100),
            'sisa_berat' => $this->faker->randomFloat(2, 1, 100),
            'avg_kadar_air' => $this->faker->randomFloat(2, 1, 100),
            'modal' => $this->faker->randomNumber(3),
            'total_modal' => $this->faker->randomNumber(6),
            'keterangan' => $this->faker->text(15),
            'user_created' => $this->faker->userName,
            'user_updated' => $this->faker->userName,
        ];
    }
}
