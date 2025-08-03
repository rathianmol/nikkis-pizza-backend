<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@nikkispizza.com',
            'password' => Hash::make('password123'), // Change this in production
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('super-admin');

        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@nikkispizza.com',
            'password' => Hash::make('password123'), // Change this in production
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create Staff member
        $staff = User::create([
            'name' => 'Pizza Chef',
            'email' => 'chef@nikkispizza.com',
            'password' => Hash::make('password123'), // Change this in production
            'email_verified_at' => now(),
        ]);
        $staff->assignRole('staff');

        // Create Staff customer
        $staff = User::create([
            'name' => 'Customer One',
            'email' => 'customer.one@example.com',
            'password' => Hash::make('password123'), // Change this in production
            'email_verified_at' => now(),
        ]);
        $staff->assignRole('customer');
    }
}
