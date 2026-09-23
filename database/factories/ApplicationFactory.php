<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'job_id' => Job::factory(),
            'cover_letter' => fake('fr_FR')->paragraphs(3, true),
            'cv_path' => null,
            'status' => fake()->randomElement(['pending', 'reviewed', 'accepted', 'rejected']),
            'applied_at' => now()->subDays(fake()->numberBetween(0, 10)),
        ];
    }
}
