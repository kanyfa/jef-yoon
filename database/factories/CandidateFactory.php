<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Candidate>
 */
class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->candidate(),
            'first_name' => fake('fr_FR')->firstName(),
            'last_name' => fake('fr_FR')->lastName(),
            'phone' => fake('fr_FR')->phoneNumber(),
            'location' => fake('fr_FR')->city(),
            'level' => fake()->randomElement([
                'Débutant', 'Confirmé', 'Expert',
            ]),
            'contract_type_preference' => fake()->randomElement([
                'CDI', 'CDD', 'Freelance', 'Stage',
            ]),
            'bio' => fake('fr_FR')->paragraph(3, true),
            'skills' => fake()->randomElements(
                ['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Python', 'Django', 'Java', 'Spring', 'Design UX', 'Figma', 'Photoshop', 'SEO', 'Marketing digital', 'Google Analytics', 'Communication'],
                fake()->numberBetween(3, 8),
            ),
            'experience' => fake('fr_FR')->paragraph(4, true),
        ];
    }
}
