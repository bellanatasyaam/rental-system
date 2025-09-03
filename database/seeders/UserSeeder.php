<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123')
            ]
        );
        $admin->assignRole('Admin');

        // Staff
        $staff = User::updateOrCreate(
            ['email' => 'staff@mail.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('password123')
            ]
        );
        $staff->assignRole('Staff');

        // Tenant
        $tenant = User::updateOrCreate(
            ['email' => 'tenant@mail.com'],
            [
                'name' => 'Tenant',
                'password' => Hash::make('pass123')
            ]
        );
        $tenant->assignRole('Tenant');
    }
}
