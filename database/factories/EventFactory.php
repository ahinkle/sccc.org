<?php

namespace Database\Factories;

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

    public function expired(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'ends_at' => $this->faker->dateTimeBetween('-1 year', 'yesterday'),
            ];
        });
    }

    public function withElexio(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'elexio_id' => $this->faker->randomNumber(),
                'elexio_batch_id' => $this->faker->uuid(),
                'elexio_updated_at' => $this->faker->dateTime(),
            ];
        });
    }
}
