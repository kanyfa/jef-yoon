<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    protected $companies = [
        ['name' => 'Orange Sonics', 'sector' => 'Télécommunications', 'location' => 'Dakar', 'description' => "Leader de la téléphonie mobile et des services numériques en Afrique de l'Ouest, Orange Sonics recrute des talents passionnés par l'innovation et le digital."],
        ['name' => 'Banque Atlantique', 'sector' => 'Finance', 'location' => 'Dakar', 'description' => "Banque de référence en Afrique de l'Ouest, offrant des solutions financières complètes aux particuliers et aux entreprises exigeant un haut niveau de service."],
        ['name' => 'Jokkolabs', 'sector' => 'Technologie', 'location' => 'Dakar', 'description' => 'Incubateur et studio de développement d\'applications numériques basé à Dakar, spécialisé dans les solutions fintech et l\'agritech.'],
        ['name' => 'Groupe Sénéchal', 'sector' => 'Commerce', 'location' => 'Pikine', 'description' => 'Chaîne de distribution alimentaire et services généraux, présente dans plusieurs régions du Sénégal avec un fort ancrage local.'],
        ['name' => 'CHU de Dakar', 'sector' => 'Santé', 'location' => 'Dakar', 'description' => 'Centre hospitalier universitaire de référence pour l\'ensemble du Sénégal, dédié à la prise en charge, la recherche et l\'enseignement médical.'],
        ['name' => 'Université Cheikh Anta Diop', 'sector' => 'Éducation', 'location' => 'Dakar', 'description' => 'Principale université publique du Sénégal, engagée dans l\'enseignement supérieur, la recherche et l\'innovation technologique.'],
        ['name' => 'Société Nationale des Chemins de Fer', 'sector' => 'Transport', 'location' => 'Dakar', 'description' => 'Opérateur ferroviaire national, chargé de la gestion et du développement du transport ferroviaire au Sénégal.'],
        ['name' => 'Société des Électricités et du Froid', 'sector' => 'Énergie', 'location' => 'Dakar', 'description' => 'Entreprise de distribution d\'électricité et de services de climatisation, implantée dans plusieurs régions du pays.'],
    ];

    public function run(): void
    {
        $user = User::where('email', 'company@jejyoon.sn')->first();
        $first = true;
        foreach ($this->companies as $company) {
            Company::create([
                'user_id' => $first ? $user->id : User::factory()->company()->create()->id,
                'name' => $company['name'],
                'sector' => $company['sector'],
                'location' => $company['location'],
                'email' => fake('fr_FR')->companyEmail(),
                'phone' => fake('fr_FR')->phoneNumber(),
                'description' => $company['description'],
                'logo' => 'logo-placeholder.png',
            ]);
            $first = false;
        }
    }
}
