<?php

namespace Database\Factories;

use App\Models\StoreLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreLocation>
 */
class StoreLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company . ' Location',
            'address_line_1' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'postal_code' => $this->faker->postcode,
            'phone_number' => $this->faker->numerify('###-###-####'), // e.g., 555-123-4567
            'email' => $this->faker->unique()->safeEmail,
            
            // Default hours: 9am - 5pm
            'monday_hours' => '9am - 5pm',
            'tuesday_hours' => '9am - 5pm',
            'wednesday_hours' => '9am - 5pm',
            'thursday_hours' => '9am - 5pm',
            'friday_hours' => '9am - 5pm',
            'saturday_hours' => '9am - 5pm',
            'sunday_hours' => '9am - 5pm',

            'is_primary' => false, // Default to false, can be overridden
            'is_active' => $this->faker->boolean(90), // 90% chance of being true
        ];
    }
}