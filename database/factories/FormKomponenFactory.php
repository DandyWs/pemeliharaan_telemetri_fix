<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\FormKomponen;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormKomponenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormKomponen::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cheked' => $this->faker->boolean(),
            'pemeliharaan2_id' => \App\Models\Pemeliharaan2::factory(),
            'detail_komponen_id' => \App\Models\DetailKomponen::factory(),
        ];
    }
}
