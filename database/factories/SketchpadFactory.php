<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sketchpad>
 */
class SketchpadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'FIO' => $this->faker->unique()->name(),
            'company' => $this->faker->company(),
            'telephone' => '+7 (' . $this->faker->numerify('###') . ') ' . $this->faker->numerify('###-##-##'),
            'email' => $this->faker->unique()->safeEmail(),
            'date_of_birth' => $this->faker->date(),
            'photo' => $this->faker->lexify('?????????????') . '.jpg',
        ];
    }
    
}
