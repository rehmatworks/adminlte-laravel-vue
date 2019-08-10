<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('asdf')
        ]);
        $superAdminRole = Role::create(['name' => env('SUPER_ADMIN_ROLE_NAME')]);
        $superAdmin->assignRole($superAdminRole);

        $admin = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe (Admin)',
            'email' => 'admin@example.com',
            'password' => Hash::make('asdf')
        ]);
        $adminRole = Role::create(['name' => 'Admin']);
        $adminPermissions = [
            'manage-users',
            'manage-site-settings'
        ];
        foreach($adminPermissions as $ap)
        {
            $permission = Permission::firstOrCreate(['name' => $ap]);
            $adminRole->givePermissionTo($permission);
        }
        $admin->assignRole($adminRole);

        $editorRole = Role::create(['name' => 'Editor']);
        $editor = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe (Editor)',
            'email' => 'editor@example.com',
            'password' => Hash::make('asdf')
        ]);
    }
}
