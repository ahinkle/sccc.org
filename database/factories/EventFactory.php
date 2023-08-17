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
            'image' => 'https://loremflickr.com/600/600/nature',
            'event_start' => $this->faker->dateTimeBetween('now', '+1 year'),
            'location' => $this->faker->company.PHP_EOL.$this->faker->address,
        ];
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
