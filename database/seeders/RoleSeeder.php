<?php

namespace Database\Seeders;

use App\Models\Role;
use Database\Factories\RoleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'city_manager']);
        Role::create(['name'=>'gym_manager']);
        Role::create(['name'=>'coach']);
        Role::create(['name'=>'client']);
    }
}
