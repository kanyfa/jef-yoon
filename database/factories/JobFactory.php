<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $title = fake()->randomElement([
            'Développeur full-stack', 'Designer UI/UX', 'Chef de projet digital',
            'Marketing digital & SEO', 'Data Analyst', 'Comptable', 'Assistante de direction',
            'Commercial terrain', 'Chef de cours', 'Chargé(e) de clientèle',
            'Ingénieur logiciel', 'Community manager', 'Traducteur', 'Web master',
            'Analyste financier', 'Chauffeur livraison', 'Technicien réseau', 'Consultant RH',
        ]);
        $skills = fake()->randomElements(
            ['PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Python', 'Django', 'Java', 'Spring', 'Design UX', 'Figma', 'Photoshop', 'SEO', 'Marketing digital', 'Google Analytics', 'Communication', 'Excel', 'Teamwork'],
            fake()->numberBetween(3, 6),
        );
        $contract = fake()->randomElement(['CDI', 'CDD', 'Intérim', 'Stage', 'Freelance', 'Temps partiel']);
        $expLevel = fake()->randomElement(['Débutant', '1-2 ans', '3-5 ans', '6-10 ans', 'Senior', 'Expert']);
        $min = fake()->numberBetween(150000, 800000);
        $max = $min + fake()->numberBetween(50000, 400000);
        $locations = ['Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Yoff', 'Ouakam', 'Mermoz', 'Thiadiaye', 'Diourbel', 'Louga'];

        return [
            'company_id' => Company::factory(),
            'title' => $title,
            'slug' => Str::slug($title . '-' . Str::random(6)),
            'location' => fake()->randomElement($locations),
            'contract_type' => $contract,
            'experience_level' => $expLevel,
            'salary_min' => $min,
            'salary_max' => $max,
            'skills_required' => $skills,
            'description' => fake('fr_FR')->paragraphs(5, true),
            'is_active' => true,
            'posted_at' => now()->subDays(fake()->numberBetween(0, 30)),
        ];
    }
}
