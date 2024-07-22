<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eventName' => $this->faker->name(),
            'eventStart' => $this->faker->unique()->dateTimeInInterval($startDate = '-4 days', $interval = '+ 5 days', $timezone = null),
            'eventEnd' => $this->faker->unique()->dateTimeInInterval($startDate = '-7 days', $interval = '+ 5 days', $timezone = null),
            'clientId' => rand(1,5)
        ];
    }
}
