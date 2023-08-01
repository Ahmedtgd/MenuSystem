<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Slider::factory()
            ->count(2)
            ->create();
        // \App\Models\User::factory(10)->create();
    }
}
