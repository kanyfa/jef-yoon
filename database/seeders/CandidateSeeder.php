<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'candidate@jejyoon.sn')->first();
        Candidate::create([
            'user_id' => $user->id,
            'first_name' => 'Moussa',
            'last_name' => 'Diop',
            'phone' => '77 234 56 78',
            'location' => 'Dakar',
            'level' => 'Confirmé',
            'contract_type_preference' => 'CDI',
            'bio' => 'Développeur web passionné, spécialisé dans les solutions Laravel et les interfaces modernes. Je recherche un poste stimulant où mes compétences technique et créative pourront apporter une réelle valeur ajoutée à votre entreprise.',
            'skills' => ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'HTML/CSS', 'Git', 'MySQL', 'API REST'],
            'experience' => "2020-2024 : Développeur web au sein de Numa Technologies, Dakar. Développement d'applications métier avec Laravel et Vue.js.\n2018-2020 : Développeur junior chez InTouch, Dakar. Création de sites e-commerce et d'applications mobiles.",
            'cv_path' => null,
        ]);

        Candidate::factory(4)->create();
    }
}
