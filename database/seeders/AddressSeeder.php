<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get pre-seeded customer user.
        $customerUser = User::where('email', 'customer.one@example.com')->first();

        $customerAddress = Address::create([
            'user_id' => $customerUser->id,
            'address_line_1' => '123 Customer One Lane',
            'address_line_2' => 'Apt 1223',
            'city' => 'Burbank',
            'state' => 'CA',
            'postal_code' => '90210'
        ]);

    }
}
