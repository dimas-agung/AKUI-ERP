<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\PrmRawMaterialOutputItem;

class PrmRawMaterialOutputItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doc_no' => $this->faker->unique()->text(10),
            'nomor_bstb' => $this->faker->unique()->randomNumber(5),
            'nomor_batch' => $this->faker->unique()->randomNumber(5),
            'id_box' => $this->faker->unique()->randomNumber(3),
            'nama_supplier' => $this->faker->unique()->company,
            'jenis' => $this->faker->word,
            'berat' => $this->faker->randomFloat(2, 1, 100),
            'kadar_air' => $this->faker->randomFloat(2, 1, 100),
            'tujuan_kirim' => $this->faker->sentence,
            'letak_tujuan' => $this->faker->sentence,
            'inisial_tujuan' => $this->faker->word,
            'modal' => $this->faker->randomNumber(3),
            'total_modal' => $this->faker->randomNumber(6),
            'keterangan_item' => $this->faker->text(15),
            'user_created' => $this->faker->userName,
            'user_updated' => $this->faker->userName,
        ];
    }
}
