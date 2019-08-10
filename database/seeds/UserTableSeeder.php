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
        $admin = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe (Admin)',
            'email' => 'admin@example.com',
            'password' => Hash::make('asdf')
        ]);
        $adminRole = Role::create(['name' => 'admin']);
        $adminPermissions = [
            'manage-users',
            'manage-site-settings'
        ];
        foreach($adminPermissions as $ap)
        {
            $permission = Permission::create(['name' => $ap]);
            $adminRole->givePermissionTo($permission);
        }
        $admin->assignRole($adminRole);

        $editor = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe (Editor)',
            'email' => 'editor@example.com',
            'password' => Hash::make('asdf')
        ]);
    }
}
