<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $lang = ($langs = ['ar', 'en','ku'])[array_rand($langs)];

        $this->faker = \Faker\Factory::create($lang == 'ar' ? 'ar_SA' : 'en_US');

        return [
            'name_ar' =>  $this->faker->text(10),
            'name_en' =>  $this->faker->text(10),
            'name_ku' =>  $this->faker->text(10),
            'name_tr' =>  $this->faker->text(10),
        ];
    }
}
