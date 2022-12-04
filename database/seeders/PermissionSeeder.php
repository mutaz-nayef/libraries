<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ---> ADMIN PAERMISSIONS <----
        // Permission::create(['name' => 'Create_', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read_', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update_', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete_', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create_Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read_Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update_Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete_Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Read_Permissions', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create_Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read_Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update_Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete_Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create_User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read_Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update_User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete_User', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create_City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read_Cities', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update_City', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete_City', 'guard_name' => 'admin']);

        // // ---> USER PAERMISSIONS <----
        // Permission::create(['name' => 'Create_', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Read_', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Update_', 'guard_name' => 'user']);
        // Permission::create(['name' => 'Delete_', 'guard_name' => 'user']);


        Permission::create(['name' => 'Read_Users', 'guard_name' => 'user']);

        Permission::create(['name' => 'Create_City', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read_Cities', 'guard_name' => 'user']);
        Permission::create(['name' => 'Update_City', 'guard_name' => 'user']);
        Permission::create(['name' => 'Delete_City', 'guard_name' => 'user']);

        // // ---> USER-API PAERMISSIONS <----
        Permission::create(['name' => 'Read_Users', 'guard_name' => 'user-api']);
        Permission::create(['name' => 'Read_Cities', 'guard_name' => 'user-api']);
    }
}
