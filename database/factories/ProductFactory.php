<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'       => Str::limit(ucfirst(fake()->words(2, true)), 20, ''),
            'description' => fake()->sentence(12),
            'price'       => fake()->randomFloat(2, 5, 900),
            'image'       => fake()->randomElement(Storage::disk('public')->files('products')),
            'active'      => true,
            'user_id'     => User::factory(),
            'category_id' => Category::inRandomOrder()->value('id')
        ];
    }

}