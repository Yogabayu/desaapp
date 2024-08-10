<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Permissions
         $superadminPermission = Permission::create([
            'name' => 'Superadmin',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);

        $adminPermission = Permission::create([
            'name' => 'Admin',
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => false,
        ]);

        // Roles
        $superadminRole = Role::create([
            'name' => 'Superadmin',
            'permission_id' => $superadminPermission->id,
        ]);

        $adminRole = Role::create([
            'name' => 'Admin',
            'permission_id' => $adminPermission->id,
        ]);

        // Users
        User::create([
            'role_id' => $superadminRole->id,
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'nip' => '1234567890',
            'password' => Hash::make('superadmin123'),
        ]);

        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nip' => '0987654321',
            'password' => Hash::make('admin123'),
        ]);
    }
}
