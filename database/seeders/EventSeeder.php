<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Event::factory()
            ->count(15)
            ->create();
    }
}
