<?php

namespace Database\Factories;

use App\Models\TaskHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaskHistory>
 */
class TaskHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'changed_column' => 'title',
            'old_value' => $this->faker->sentence,
            'new_value' => $this->faker->sentence,
            'task_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
