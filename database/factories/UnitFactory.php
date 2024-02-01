<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Unit;
use App\Models\Workstation;
use Faker\Generator as Faker;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Buat data Workstation terlebih dahulu
        $workstation = Workstation::factory()->create();

        return [
            'workstation_id' => $workstation->id,
            'nama' => $this->faker->unique()->company,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
