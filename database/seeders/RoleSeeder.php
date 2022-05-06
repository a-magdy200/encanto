<?php

namespace Database\Seeders;

use Database\Factories\RoleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin_role=Role::create(['name'=>'Super Admin']);
        $city_manager_role=Role::create(['name'=>'City Manager']);
        $gym_manager_role=Role::create(['name'=>'Gym Manager']);
        $coach_role=Role::create(['name'=>'Coach']);
        $client_role=Role::create(['name'=>'Client']);
        $create_gym=Permission::create(['name' => 'Create Gym']);
        $update_gym=Permission::create(['name' => 'Update Gym']);
        $read_gym=Permission::create(['name' => 'Read Gym']);
        $delete_gym=Permission::create(['name' => 'Delete Gym']);
        $create_gym_manager=Permission::create(['name' => 'Create gym_manager']);
        $read_gym_manager=Permission::create(['name' => 'Read gym_manager']);
        $update_gym_manager=Permission::create(['name' => 'Update gym_manager']);
        $delete_gym_manager=Permission::create(['name' => 'Delete gym_manager']);
        $ban_gym_manager=Permission::create(['name' => 'ban gym_manager']);
        $unban_gym_manager=Permission::create(['name' => 'unban gym_manager']);
        $create_training_sessions=Permission::create(['name' => 'Create training_sessions']);
        $read_training_sessions=Permission::create(['name' => 'Read training_sessions']);
        $update_training_sessions=Permission::create(['name' => 'Update training_sessions']);
        $delete_training_sessions=Permission::create(['name' => 'Delete training_sessions']);
        // $create_training_packages=Permission::create(['name' => 'Create training_sessions']);
        // $read_training_packages=Permission::create(['name' => 'Read training_sessions']);
        // $update_training_packages=Permission::create(['name' => 'Update training_sessions']);
        // $delete_training_packages=Permission::create(['name' => 'Delete training_sessions']);
        $assign_coache_to_training_sessions=Permission::create(['name' => 'assign coach training_sessions']);
        $buy_training_packages=Permission::create(['name' => 'buy training_packages']);
        $create_attendance=Permission::create(['name' => 'Create attendance']);
        $read_attendance=Permission::create(['name' => 'Read attendance']);
        $update_attendance=Permission::create(['name' => 'Update attendance']);
        $delete_attendance=Permission::create(['name' => 'Delete attendance']);
        $city_managers_permissions=[$create_gym_manager,$read_gym_manager,$update_gym_manager,$delete_gym_manager,$ban_gym_manager,$unban_gym_manager,$create_gym,
            $update_gym,$read_gym,$delete_gym,$create_training_sessions,$read_training_sessions,$update_training_sessions,$delete_training_sessions,$assign_coache_to_training_sessions,
            $buy_training_packages,$create_attendance,$read_attendance,$update_attendance,$delete_attendance
        ];
        $admin_role->givePermissionTo(Permission::all());
    $city_manager_role->givePermissionTo($city_managers_permissions);
//    $city_manager_user=User::where('role_id','2');
//    $city_manager_user->givePermissionTo($city_managers_permissions);







    }
}
