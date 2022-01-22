<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'dni' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'names' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'age' => $this->faker->numberBetween(18, 60),
            // 'photo' => $this->faker->imageUrl(300, 300, 'people'),
        ];
    }
}
