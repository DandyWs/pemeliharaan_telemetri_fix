<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AlatTelemetri;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlatTelemetriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AlatTelemetri::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lokasiStasiun' => $this->faker->text(255),
            'jenis_alat_id' => \App\Models\JenisAlat::factory(),
        ];
    }
}
