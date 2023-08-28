<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsSubmissionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email_address' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'subject' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'ip_address' => $this->faker->ipv4,
        ];
    }
}
