<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $candidate = User::where('email', 'candidate@jejyoon.sn')->first();
        $jobs = Job::active()->inRandomOrder()->limit(3)->get();

        foreach ($jobs as $job) {
            Application::create([
                'user_id' => $candidate->id,
                'job_id' => $job->id,
                'cover_letter' => "Bonjour,\n\nJe suis développeur web passionné avec une expérience solide en développement d'applications Laravel et Vue.js. Je suis convaincu que mes compétences pourraient apporter une réelle valeur ajoutée à votre entreprise pour ce poste de {$job->title}.\n\nJe reste à votre disposition pour un entretien et vous remercie par avance de l'attention portée à ma candidature.\n\nCordialement,\nMoussa Diop",
                'cv_path' => null,
                'status' => 'pending',
                'applied_at' => now()->subDays(fake()->numberBetween(0, 5)),
            ]);
        }

        Application::factory(8)->create();
    }
}
