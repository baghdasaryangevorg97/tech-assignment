<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'website_id' => $this->faker->numberBetween(1, 100),
            'revenue' => $this->faker->randomFloat(2, 0, 1000),
            'impressions' => $this->faker->numberBetween(1000, 100000),
            'clicks' => $this->faker->numberBetween(100, 10000),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
        ];
    }
}
