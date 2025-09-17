<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat daftar permission
        $permissions = [
            'manage users',
            'manage properties',
            'manage tenants',
            'manage contracts',
            'manage payments',
            'view reports',

            // Tambah khusus tamu
            'view property_unit',
            'view contract',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role
        $admin  = Role::firstOrCreate(['name' => 'Admin']);
        $staff  = Role::firstOrCreate(['name' => 'Staff']);
        $tenant = Role::firstOrCreate(['name' => 'Tenant']);
        $tamu   = Role::firstOrCreate(['name' => 'Tamu']); // baru

        // Assign permission ke role
        $admin->givePermissionTo(Permission::all());
        $staff->givePermissionTo([
            'manage tenants',
            'manage contracts',
            'manage payments',
            'view reports'
        ]);
        $tenant->givePermissionTo([]);

        // Tamu cuma bisa view
        $tamu->givePermissionTo([
            'view property_unit',
            'view contract'
        ]);
    }
}
