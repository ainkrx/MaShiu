<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'image'=> fake()->image(storage_path('public/img/'),100,100,'nature',false),
            'user_id' => fake()->numberBetween(1, 50),
            'date' => fake()->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
