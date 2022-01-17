<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'categoria_id' => $this->faker->numberBetween(1, 10),
            'titulo' => $this->faker->slug,
            'contenido' => $this->faker->text(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
