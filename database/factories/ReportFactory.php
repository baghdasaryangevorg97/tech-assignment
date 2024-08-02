<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'revenue' => $this->faker->randomFloat(2, 0, 1000),
            'impressions' => $this->faker->numberBetween(1000, 100000),
            'clicks' => $this->faker->numberBetween(100, 10000),
        ];
    }

    public function withCustomData($websiteId, $date)
    {
        return $this->state([
            'website_id' => $websiteId,
            'date' => $date,
        ]);
    }
}
