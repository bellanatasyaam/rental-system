<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
   {
        $this->call(RolePermissionSeeder::class);

        // Assign role Admin ke user pertama
        $admin = User::find(1);
        if ($admin) {
            $admin->assignRole('Admin');
        }
    }
}
