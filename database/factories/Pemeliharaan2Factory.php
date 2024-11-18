<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Pemeliharaan2;
use Illuminate\Database\Eloquent\Factories\Factory;

class Pemeliharaan2Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemeliharaan2::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => $this->faker->dateTime(),
            'waktu' => $this->faker->time(),
            'periode' => $this->faker->text(255),
            'cuaca' => $this->faker->text(255),
            'no_alatUkur' => $this->faker->randomNumber(0),
            'no_GSM' => $this->faker->randomNumber(0),
            'alat_telemetri_id' => \App\Models\AlatTelemetri::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
