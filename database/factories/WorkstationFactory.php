<?php

namespace Database\Factories;
use App\Models\Perusahaan;
use App\Models\Workstation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\workstation>
 */
class WorkstationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Workstation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $perusahaan = Perusahaan::factory()->create();
        return [
            'perusahaan_id' => $perusahaan->id,
            'nama' => $this->faker->unique()->company,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
