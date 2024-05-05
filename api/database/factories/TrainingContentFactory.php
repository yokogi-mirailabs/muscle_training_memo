<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingContent>
 */
class TrainingContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'weight' => $this->faker->randomFloat(10, 20, 30),
            'reps' => $this->faker->numberBetween(10, 20),
            'sets' => $this->faker->numberBetween(2, 5),
            'training_date' => $this->faker->date(),
        ];
    }
}
