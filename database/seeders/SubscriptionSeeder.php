<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['name'=>'vip'],
            ['name'=>'normal'],
        ];

        DB::table('subscriptions')->insert($array);
    }
}
