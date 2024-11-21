<?php

namespace Database\Factories;

use App\Models\JenisAlat;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisAlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JenisAlat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'namajenis' => $this->faker->text(255),
            'setting' => $this->faker->boolean(),
        ];
    }
}
