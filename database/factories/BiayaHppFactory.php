<?php

// database/factories/BiayaHppFactory.php

namespace Database\Factories;

use App\Models\BiayaHpp;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class BiayaHppFactory extends Factory
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
            'unit_id' => $unit->id,
            'jenis_biaya' => $this->faker->randomNumber(2),
            'biaya_per_gram' => $this->faker->randomNumber(2),
            'status' => $this->faker->randomNumber(1),
        ];
    }
}

