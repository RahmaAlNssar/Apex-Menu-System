<?php

namespace Database\Factories;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'category_id' => fake()->randomElement(Category::pluck('id')->toArray()),
            'name_ar' =>  fake()->text(10),
            'name_en' =>  fake()->text(10),
            'name_ku' =>  fake()->text(10),
            'name_tr' =>  fake()->text(10),
            'text_ar' =>  fake()->text(50),
            'text_en' =>  fake()->text(50),
            'text_ku' =>  fake()->text(50),
            'text_tr' =>  fake()->text(50),
            'price'   => fake()->numberBetween(1000, 6000)
        ];
    }
}
