<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Order management
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',
            'process orders',
            
            // Menu-Items management (for pizza shop)
            'view menuItems',
            'create menuItems',
            'edit menuItems',
            'delete menuItems',
            
            // Analytics/Reports
            // 'view analytics',
            // 'view feedback',
            
            // System settings
            // 'manage settings',
            'view logs',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Super Admin - has all permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin - has most permissions except critical system ones
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view users',
            'create users',
            'edit users',
            'view orders',
            'create orders',
            'edit orders',
            'delete orders',
            'process orders',
            'view menuItems',
            'create menuItems',
            'edit menuItems',
            'delete menuItems',
            'view logs',
        ]);

        // Staff/Employee - for pizza shop staff
        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
            'view orders',
            'edit orders', // update the status of orders
            'process orders',
            'view menuItems',
        ]);

        // Customer - basic permissions
        $customerRole = Role::create(['name' => 'customer']);
        $customerRole->givePermissionTo([
            'view menuItems',
            'create orders',
            'view orders', // only their own orders (implement in policy)
        ]);


    }
}
