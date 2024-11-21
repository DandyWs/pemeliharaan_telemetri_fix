<?php

namespace Database\Factories;

use App\Models\Komponen2;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class Komponen2Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Komponen2::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->text(255),
        ];
    }
}
