<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::random(10),
            // 'image' => $this->faker->imageUrl(480, 270)
            'image' => $this->faker->image(storage_path('images'), 480, 270)
        ];
    }
}
