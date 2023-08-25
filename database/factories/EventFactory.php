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
            'location' => $this->faker->company(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
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

    public function repeats(EventFrequency $eventFrequency = null): self
    {
        return $this->state(function (array $attributes) use ($eventFrequency) {
            return [
                'repeat_frequency' => $eventFrequency ?? $this->faker->randomElement(EventFrequency::values()),
            ];
        });
    }

    public function expired(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'ends_at' => $this->faker->dateTimeBetween('-1 year', 'yesterday'),
            ];
        });
    }
}
