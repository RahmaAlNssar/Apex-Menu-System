<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Code;
use Spatie\Permission\Models\Role;
use App\Models\Theme;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Permission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
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
            'owner_name'=>fake()->name(),
            'status'=>1,
            'email' => fake()->unique()->safeEmail(),
            'restaurant_code'=>fake()->text(6),
            //'token'=>Str::random(15),
            'is_admin'=>0,
            'restaurant_name'=>fake()->name(),
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            //'role_id'=>fake()->randomElement(Role::pluck('id')->toArray()),
            'phone_restaurant'=>fake()->phoneNumber(),
            'phone_owner'=>fake()->phoneNumber(),
            'address'=>fake()->text(100),
            'start_reg'=>$startDate->toDateString(),
            'end_reg'=>$startDate->addHours( fake()->numberBetween( 1, 8 ) ),
            'price_reg'=>fake()->numberBetween(13445,66788),
           // 'code_id'=>fake()->randomElement(Code::pluck('id')->toArray()),
            'added_by'=>1,
            'facebook'=>'https:://facebook.com',
            'insta'=>'https:://instagram.com',
            'snapchat'=>'https:://snapchat.com',
            'theme_id' => fake()->randomElement(Theme::pluck('id')->toArray()),
            'subscription_id' => fake()->randomElement(Subscription::pluck('id')->toArray()),
        ];
    }
}
