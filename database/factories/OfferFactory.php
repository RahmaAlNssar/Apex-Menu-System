<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = Carbon::createFromTimeStamp(fake()->dateTimeBetween('-1 years', '+1 month')->getTimestamp());

        return [
            'name_ar' =>  fake()->text(10),
            'name_en' =>  fake()->text(10),
            'name_ku' =>  fake()->text(10),
            'name_tr' =>  fake()->text(10),
            'first_title_ar' =>  fake()->text(15),
            'first_title_en' =>  fake()->text(15),
            'first_title_ku' =>  fake()->text(15),
            'first_title_tr' =>  fake()->text(15),
            'second_title_ar' =>  fake()->text(15),
            'second_title_en' =>  fake()->text(15),
            'second_title_ku' =>  fake()->text(15),
            'second_title_tr' =>  fake()->text(15),
            'third_title_ar' =>  fake()->text(15),
            'third_title_en' =>  fake()->text(15),
            'third_title_ku' =>  fake()->text(15),
            'third_title_tr' =>  fake()->text(15),
            'start_date'=>$startDate->toDateString(),
            'end_date'=>$startDate->addHours( fake()->numberBetween( 1, 8 ) ),
        ];
    }
}
