<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->company(),
            'name' => fake('fr_FR')->company(),
            'sector' => fake()->randomElement([
                'Technologie', 'Télécommunications', 'Finance', 'Commerce',
                'Santé', 'Éducation', 'Transport', 'Énergie',
            ]),
            'location' => fake('fr_FR')->city(),
            'email' => fake('fr_FR')->companyEmail(),
            'phone' => fake('fr_FR')->phoneNumber(),
            'description' => fake('fr_FR')->paragraph(3, true),
            'logo' => 'logo-placeholder.png',
        ];
    }
}
