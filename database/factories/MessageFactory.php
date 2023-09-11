<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'youtube_url' => $this->faker->url,
            'thumbnail_url' => $this->faker->imageUrl(640, 480, 'people'),
            'message_date' => $this->faker->date,
        ];
    }
}
