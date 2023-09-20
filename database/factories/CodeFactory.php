<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $admin = Admin::where('is_admin',1)->first();
        return [
            'code'=>Str::random(5),
            'admin_id'=>$admin->id,
        ];
    }
}
