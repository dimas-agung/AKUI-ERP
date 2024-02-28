<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\MasterJenisGradingKasar;

class MasterJenisGradingKasarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->unique()->company,
            'kategori_susut' => $this->faker->unique()->company,
            'upah_operator' => $this->faker->randomNumber(3),
            'presentase_pengurangan_harga' => $this->faker->randomNumber(2),
            'harga_estimasi' => $this->faker->randomNumber(3),
            'status' => $this->faker->randomElement([0, 1]),
            'user_created' => $this->faker->userName,
            'user_updated' => $this->faker->userName,
        ];
    }
}
