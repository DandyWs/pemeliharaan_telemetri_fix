<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DetailKomponen;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailKomponenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailKomponen::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namadetail' => $this->faker->text(255),
            'komponen2_id' => \App\Models\Komponen2::factory(),
        ];
    }
}
