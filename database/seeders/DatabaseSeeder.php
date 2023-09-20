<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(ThemeSeeder::class);
        $this->call( SubscriptionSeeder::class);
        $this->call(AdminSeeder::class);
        \App\Models\Code::factory(10)->create();

        \App\Models\Admin::factory(10)->create();
        $this->call([

            PermessionSeeder::class,
            // RoleSeeder::class,


        ]);
        \App\Models\Category::factory(10)->create();
        \App\Models\Item::factory(10)->create();
        \App\Models\Offer::factory(10)->create();
        \App\Models\Image::factory(10)->create();



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
