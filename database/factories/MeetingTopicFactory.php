<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingTopicFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'updated_by_id' => User::factory(),
        ];
    }
}
