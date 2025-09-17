<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        // Admin khusus
        $admin = User::firstOrCreate(
            ['email' => 'bellanatasyaam@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('adminpassword123'),
            ]
        );
        $admin->assignRole('Admin');

        // Contoh Staff default (nanti bisa dihapus atau ditambah)
        $staff = User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('staffpassword123'),
            ]
        );
        $staff->assignRole('Staff');
    }
}
