<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Item;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image'=>fake()->imageUrl(200,200,null),
            'category_id' => fake()->randomElement(Category::pluck('id')->toArray()),
            'item_id' => fake()->randomElement(Item::pluck('id')->toArray()),
            'offer_id' => fake()->randomElement(Offer::pluck('id')->toArray()),
            'admin_id'=> fake()->randomElement(Admin::pluck('id')->toArray()),
        ];
    }
}
