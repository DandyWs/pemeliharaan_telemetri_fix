<?php

namespace Database\Factories;

use App\Models\Setting2;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class Setting2Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting2::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'simulasi' => $this->faker->text(255),
            'display' => $this->faker->text(255),
            'form_komponen_id' => \App\Models\FormKomponen::factory(),
        ];
    }
}
