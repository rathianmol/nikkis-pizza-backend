<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoreLocation;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreLocation::factory()->create([
            'name' => 'Main Store',
            'address_line_1' => '123 Main Street',
            'city' => 'New York',
            'state' => 'NY',
            'postal_code' => '10001',
            'phone_number' => '555-123-4567',
            'email' => 'main@store.com',
            'monday_hours' => '9am - 5pm',
            'tuesday_hours' => '9am - 5pm',
            'wednesday_hours' => '9am - 5pm',
            'thursday_hours' => '9am - 5pm',
            'friday_hours' => '9am - 5pm',
            'saturday_hours' => '9am - 5pm',
            'sunday_hours' => '9am - 5pm',
            'is_primary' => true,
            'is_active' => true,
        ]);

        StoreLocation::factory()->create([
            'name' => 'Second Store',
            'address_line_1' => '123 Secon Street',
            'city' => 'New York',
            'state' => 'NY',
            'postal_code' => '10002',
            'phone_number' => '555-123-4321',
            'email' => 'second_store@store.com',
            'monday_hours' => '9am - 5pm',
            'tuesday_hours' => '9am - 5pm',
            'wednesday_hours' => '9am - 5pm',
            'thursday_hours' => '9am - 5pm',
            'friday_hours' => '9am - 5pm',
            'saturday_hours' => '9am - 5pm',
            'sunday_hours' => '9am - 5pm',
            'is_primary' => false,
            'is_active' => true,
        ]);


        StoreLocation::factory()->create([
            'name' => 'Third Store',
            'address_line_1' => '123 Third Street',
            'city' => 'New York',
            'state' => 'NY',
            'postal_code' => '10003',
            'phone_number' => '555-123-1234',
            'email' => 'third_store@store.com',
            'monday_hours' => '9am - 5pm',
            'tuesday_hours' => '9am - 5pm',
            'wednesday_hours' => '9am - 5pm',
            'thursday_hours' => '9am - 5pm',
            'friday_hours' => '9am - 5pm',
            'saturday_hours' => '9am - 5pm',
            'sunday_hours' => '9am - 5pm',
            'is_primary' => false,
            'is_active' => true,
        ]);

    }
}
