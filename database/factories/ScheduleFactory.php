<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Shift;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'employee_id' => $faker->numberBetween(1, 5),
            'location_id' => $faker->numberBetween(1, 5),
            'shift_id' => $faker->numberBetween(1, 5),
        ];
    }
}
