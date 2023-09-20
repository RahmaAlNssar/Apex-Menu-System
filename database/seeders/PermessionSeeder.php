<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permission1 = Permission::create(['name' => 'admins-create']);
        $permission2 =  Permission::create(['name' => 'admins-index']);
        $permission3 = Permission::create(['name' => 'admins-edit']);
        $permission4 = Permission::create(['name' => 'admins-destroy']);
        $permission5 = Permission::create(['name' => 'items-create']);
        $permission6 = Permission::create(['name' => 'items-index']);
        $permission7 = Permission::create(['name' => 'items-edit']);
        $permission8 = Permission::create(['name' => 'items-destroy']);
        $permission9 = Permission::create(['name' => 'categories-create']);
        $permission10 = Permission::create(['name' => 'categories-index']);
        $permission11 = Permission::create(['name' => 'categories-edit']);
        $permission12 = Permission::create(['name' => 'categories-destroy']);
        $permission13 = Permission::create(['name' => 'offers-create']);
        $permission14 = Permission::create(['name' => 'offers-index']);
        $permission15 = Permission::create(['name' => 'offers-edit']);
        $permission16 = Permission::create(['name' => 'offers-destroy']);


        $restaurant = Role::create(['name' => 'restaurant']);


        $restaurant->givePermissionTo([$permission5, $permission6, $permission7, $permission8, $permission9, $permission10, $permission11, $permission12, $permission13, $permission14, $permission15]);

        $restaurants = Admin::where('is_admin', 0)->get();

        if (count($restaurants) > 0) {
            foreach ($restaurants as $res) {
                $res->assignRole($restaurant);
            }
        }
    }
}
