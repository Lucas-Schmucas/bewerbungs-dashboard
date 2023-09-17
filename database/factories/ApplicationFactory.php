<?php

namespace Database\Factories;

use App\Models\Status;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dates = [
            Status::SENT => now()->subDays(rand(20,40)),
            Status::PREPARING_FOR_INTERVIEW => now()->subDays(rand(5,10)),
        ];

        return [
            'company_name' => fake()->company,
            'url' => fake()->url,
            'position_name' => fake()->jobTitle,
            'expected_salary' => fake()->numberBetween(50000, 70000),
            'application_sent' => fake()->dateTimeBetween('-1 week', 'now'),
            'notes' => fake()->paragraph,
            'status_id' => $status = fake()->numberBetween(1, 2),
            'first_reply' => $dates[$status],
        ];
    }

    public function withInterviewDate(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => Status::PREPARING_FOR_INTERVIEW,
                'application_sent' => fake()->dateTimeBetween('-1 week', 'now'),
                'first_reply' => fake()->dateTimeBetween('now', '+2 day'),
                'interview_date' => fake()->dateTimeBetween('+3 day', '+10 days')
            ];
        });
    }

    public function finished() : Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => fake()->randomElement([
                    Status::ACCEPTED, Status::DECLINED
                ]),
                'application_sent' => fake()->dateTimeBetween('-2 week', '-1 week'),
                'first_reply' => fake()->dateTimeBetween('-1 week', '-5 day'),
                'interview_date' => fake()->dateTimeBetween('-4 day', '-1 day')
            ];
        });
    }

}
