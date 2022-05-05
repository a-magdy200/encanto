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
        
        $admin_role=Role::create(['name'=>'admin']);
        $city_manager_role=Role::create(['name'=>'city_manager']);
        $gym_manager_role=Role::create(['name'=>'gym_manager']);
        $coach_role=Role::create(['name'=>'coach']);
        $client_role=Role::create(['name'=>'client']);
        $create_gym=Permission::create(['name' => 'create gym']);
        $update_gym=Permission::create(['name' => 'update gym']);
        $read_gym=Permission::create(['name' => 'read gym']);
        $delete_gym=Permission::create(['name' => 'delete gym']);
        $create_gym_manager=Permission::create(['name' => 'create gym_manager']);
        $read_gym_manager=Permission::create(['name' => 'read gym_manager']);
        $update_gym_manager=Permission::create(['name' => 'update gym_manager']);
        $delete_gym_manager=Permission::create(['name' => 'delete gym_manager']);
        $ban_gym_manager=Permission::create(['name' => 'ban gym_manager']);
        $unban_gym_manager=Permission::create(['name' => 'unban gym_manager']);
        $create_training_sessions=Permission::create(['name' => 'create training_sessions']);
        $read_training_sessions=Permission::create(['name' => 'read training_sessions']);
        $update_training_sessions=Permission::create(['name' => 'update training_sessions']);
        $delete_training_sessions=Permission::create(['name' => 'delete training_sessions']);
        // $create_training_packages=Permission::create(['name' => 'create training_sessions']);
        // $read_training_packages=Permission::create(['name' => 'read training_sessions']);
        // $update_training_packages=Permission::create(['name' => 'update training_sessions']);
        // $delete_training_packages=Permission::create(['name' => 'delete training_sessions']);
        $assign_coache_to_training_sessions=Permission::create(['name' => 'assign coach training_sessions']);
        $buy_training_packages=Permission::create(['name' => 'buy training_packages']);
        $create_attendance=Permission::create(['name' => 'create attendance']);
        $read_attendance=Permission::create(['name' => 'read attendance']);
        $update_attendance=Permission::create(['name' => 'update attendance']);
        $delete_attendance=Permission::create(['name' => 'delete attendance']);
        $city_managers_permissions=[$create_gym_manager,$read_gym_manager,$update_gym_manager,$delete_gym_manager,$ban_gym_manager,$unban_gym_manager,$create_gym,
        $update_gym,$read_gym,$delete_gym,$create_training_sessions,$read_training_sessions,$update_training_sessions,$delete_training_sessions,$assign_coache_to_training_sessions,
        $buy_training_packages,$create_attendance,$read_attendance,$update_attendance,$delete_attendance
    ];
    $city_manager_role->givePermissionTo($city_managers_permissions);
    $city_manager_user=User::where('role_id','2');
    $city_manager_user->givePermissionTo($city_managers_permissions);







    }
}
