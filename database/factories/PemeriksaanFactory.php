<?php

namespace Database\Factories;

use App\Models\Pemeriksaan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemeriksaanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemeriksaan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ttd' => $this->faker->text(255),
            'catatan' => $this->faker->text(255),
            'pemeliharaan2_id' => \App\Models\Pemeliharaan2::factory(),
        ];
    }
}
