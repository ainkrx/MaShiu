<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $item=1;
        return [
            // 'image'=> fake()->image(storage_path('public/img/'),100,100,'nature',false),
            'image'=>'nike af1.jpg',
            // 'name' => fake()->unique()->numerify("Cloth-####"),
            'name' => "Shoes - ".$item++,
            'description' => fake()->regexify('[A-Za-z0-9]{20}'),
            'stock' => fake()->numberBetween(0, 100),
            'price' => fake()->numberBetween(10000, 100000)
        ];
    }
}
