<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsletterContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }

    public function verified(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
            ];
        });
    }
}
