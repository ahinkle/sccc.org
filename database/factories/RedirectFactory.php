<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Redirect>
 */
class RedirectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'from' => $this->faker->slug(),
            'to' => $this->faker->slug(),
            'code' => $this->faker->randomElement([301, 302]),
        ];
    }

    public function permanent(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'code' => 301,
            ];
        });
    }

    public function temporary(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'code' => 302,
            ];
        });
    }
}
