<?php

namespace Database\Factories;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'title' => [
                'en' => $this->faker->word,
                'ar' => $this->faker->word,
            ],
            'description' => [
                'en' => $this->faker->sentence,
                'ar' => $this->faker->sentence,
            ],
            'link' => 'https://www.eraasoft.com',
            'payment_status' => fake()->randomElement(['paid', 'unpaid']),
            'delivery_date' => now()->addDays(random_int(1, 10)),
            'status_id' => fake()->numberBetween(1, 4),
            'phase_id' => fake()->numberBetween(1, 6),
            'reporter_id' => fake()->numberBetween(1, 10),
            'assigned_id' => fake()->numberBetween(1, 10),
            'client_id' => fake()->numberBetween(1, 10),
        ];
    }
}
