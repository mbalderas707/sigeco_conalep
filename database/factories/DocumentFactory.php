<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'folio'=>$this->faker->sentence(1),
            'subject'=>$this->faker->sentence(3),
            'description'=>$this->faker->paragraph(1),
            'filed'=>false,
            'received_since'=>now(),
            'document_date'=>now(),
        ];
    }
}
