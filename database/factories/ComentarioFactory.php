<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => $this->faker->numberBetween(1, 10),
            'contenido' => $this->faker->text(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
