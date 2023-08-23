<?php

namespace Database\Factories;

use App\Enums\EventFrequency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->text,
            'image' => 'https://via.placeholder.com/400x400',
            'starts_at' => $this->faker->dateTime(),
            'location' => $this->faker->company.PHP_EOL.$this->faker->address,
        ];
    }

    public function upcoming(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'starts_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            ];
        });
    }

    public function past(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'starts_at' => $this->faker->dateTimeBetween('-1 year', 'yesterday'),
            ];
        });
    }

    public function repeats(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'repeat_frequency' => $this->faker->randomElement(EventFrequency::values()),
            ];
        });
    }
}
