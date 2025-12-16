<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'name' => 'Admin',
            'email' => 'hasibjey@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
        ]);

        // Create permissions with 'admin' guard
        $categories = ['permissions', 'roles', 'admins'];
        $cruds = ['view', 'create', 'update', 'delete'];

        foreach ($categories as $key => $category) {
            foreach ($cruds as $key => $crud) {
                Permission::firstOrCreate([
                    'guard_name' => 'web',
                    'name' => $category . ' ' . $crud,
                ]);
            }
        }

        // Create the 'admin' role with the 'admin' guard
        $role = Role::firstOrCreate([
            'guard_name' => 'web',
            'name' => 'super admin'
        ]);

        // Assign permissions to the role
        $permissions = Permission::where('guard_name', 'web')->get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        // Assign the role to the user
        $user->assignRole('super admin');
    }
}
