<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TurnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seen_since' => now(),
            'expiration' => now()->addDays(15),
            'additional_instructions'=>$this->faker->text(),
            'concluded'=>false
        ];
    }
}
