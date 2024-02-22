<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\PreGradingHalusAddingStock;
use App\Models\Unit;

class PreGradingHalusAddingStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a new Unit or get an existing one
        $unit = Unit::factory()->create();
        return [
            'unit' => $unit->nama,
            'nomor_grading' => $this->faker->unique()->randomNumber(9),
            'id_box_grading_kasar' => $this->faker->unique()->randomNumber(9),
            'nomor_batch' => $this->faker->unique()->randomNumber(5),
            'nomor_nota_internal' => $this->faker->unique()->randomNumber(5),
            'nama_supplier' => $this->faker->unique()->userName,
            'jenis_raw_material' => $this->faker->company,
            'kadar_air' => $this->faker->randomFloat(2, 1, 100),
            'berat_adding' => $this->faker->randomFloat(2, 1, 100),
            'pcs_adding' => $this->faker->randomFloat(2, 1, 100),
            'modal' => $this->faker->randomNumber(6),
            'total_modal' => $this->faker->randomNumber(6),
            'status_stock' => $this->faker->randomElement([0, 1])
        ];
    }
}
