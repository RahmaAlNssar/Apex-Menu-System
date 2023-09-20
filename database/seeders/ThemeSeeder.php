<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['name'=>'bright'],
            ['name'=>'casual'],
            ['name'=>'moody'],
            ['name'=>'modern'],
            ['name'=>'vip'],
        ];

        DB::table('themes')->insert($array);

    }
}
