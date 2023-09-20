<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'email'=>'admin@gmail.com',
            'token'=>Str::random(15),
            'password'=>Hash::make('password'),
            'is_admin'=>1
        ]);
        $permissions = Permission::pluck('id', 'id')->all();
        $admin->syncPermissions($permissions);
        $restaurant = Role::create(['name' => 'admin']);
        $admin->assignRole($restaurant);
    }
}
