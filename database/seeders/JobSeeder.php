<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    protected $jobs = [
        [
            'title' => 'Développeur full-stack Laravel/Vue.js',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '3-5 ans',
            'skills' => ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'MySQL', 'Git'],
            'salary_min' => 350000,
            'salary_max' => 550000,
            'description' => "Rejoignez notre équipe de développement en tant que développeur full-stack. Vous développerez des applications métier robustes avec Laravel au backend et Vue.js au frontend. Vous travaillerez en agence à Dakar dans une équipe pluridisciplinaire et innovante.",
        ],
        [
            'title' => 'Designer UI/UX',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '1-2 ans',
            'skills' => ['Figma', 'Design', 'Photoshop', 'Prototypage', 'UX'],
            'salary_min' => 280000,
            'salary_max' => 420000,
            'description' => "Nous recherchons un designer UI/UX créatif pour rejoindre notre équipe produit. Vous concevrez des interfaces modernes et intuitives pour nos applications mobiles et web, en travaillant en étroite collaboration avec les développeurs et chefs de produit.",
        ],
        [
            'title' => 'Commercial terrain (secteur télécom)',
            'location' => 'Pikine',
            'contract_type' => 'CDI',
            'experience_level' => '1-2 ans',
            'skills' => ['Commercial', 'Télécommunications', 'Négociation', 'Relation client'],
            'salary_min' => 220000,
            'salary_max' => 350000,
            'description' => "Vous évoluerez dans le secteur des télécommunications, avec pour mission le développement du portefeuille client dans la région de Pikine et Guediawaye. Bonne connaissance du terrain et goût du résultat sont requis.",
        ],
        [
            'title' => 'Marketing digital & SEO',
            'location' => 'Dakar',
            'contract_type' => 'CDD',
            'experience_level' => '3-5 ans',
            'skills' => ['SEO', 'Google Analytics', 'Marketing digital', 'Facebook Ads', 'Content'],
            'salary_min' => 250000,
            'salary_max' => 400000,
            'description' => "Nous recherchons un chargé de marketing digital pour animer nos campagnes en ligne, optimiser notre référencement naturel et gérer nos campagnes publicitaires. Résultats ambitieux, environnement dynamique.",
        ],
        [
            'title' => 'Data Analyst',
            'location' => 'Rufisque',
            'contract_type' => 'CDI',
            'experience_level' => '6-10 ans',
            'skills' => ['Python', 'Excel', 'SQL', 'Data viz', 'Statistiques'],
            'salary_min' => 450000,
            'salary_max' => 700000,
            'description' => "En tant que data analyst, vous transformerez les données brutes en insights actionnables. Vous travaillerez avec Python, SQL et Excel pour produire des tableaux de bord et des rapports stratégiques au profit des équipes métier.",
        ],
        [
            'title' => 'Assistante de direction',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '1-2 ans',
            'skills' => ['Organisation', 'Excel', 'Communication', 'Multitâche'],
            'salary_min' => 200000,
            'salary_max' => 300000,
            'description' => "Vous soutiendrez le quotidien de la direction dans une entreprise dynamique située au cœur de Dakar. Organisation, réactivité et discrétion sont les qualités attendues pour ce poste en CDI à temps plein.",
        ],
        [
            'title' => 'Chef de projet digital',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '6-10 ans',
            'skills' => ['Pilotage', 'Agile', 'Digital', 'Leadership', 'Jira'],
            'salary_min' => 500000,
            'salary_max' => 800000,
            'description' => "Dirigez des projets numériques transversaux dans un environnement exigeant. Vous animerez des réunions, prioriserez les fonctionnalités et suivrez la réalisation des livrables avec l'appui de vos équipes techniques et métier.",
        ],
        [
            'title' => 'Comptable certifié',
            'location' => 'Pikine',
            'contract_type' => 'CDI',
            'experience_level' => '3-5 ans',
            'skills' => ['Comptabilité', 'Excel', 'ERP', 'Fiscalité', 'Audit'],
            'salary_min' => 300000,
            'salary_max' => 450000,
            'description' => "Vous assurerez la tenue comptable complète, la paie et la conformité fiscale d'une société en pleine expansion à Pikine. Un poste stable avec des perspectives d'évolution en tant que comptable principal.",
        ],
        [
            'title' => 'Chargé de clientèle téléphonique',
            'location' => 'Dakar',
            'contract_type' => 'Intérim',
            'experience_level' => 'Débutant',
            'skills' => ['Téléphonie', 'Service client', 'CRM', 'Empathie'],
            'salary_min' => 130000,
            'salary_max' => 170000,
            'description' => "Poste en intérim pour un centre de services à Dakar. Vous gérerez les appels entrants et sortants de clients, traiterez les réclamations et recommandez des solutions adaptées. Idéal pour une première expérience professionnelle.\"",
        ],
        [
            'title' => 'Ingénieur logiciel (fintech)',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => 'Expert',
            'skills' => ['Python', 'Django', 'API', 'Blockchain', 'Sécurité'],
            'salary_min' => 600000,
            'salary_max' => 950000,
            'description' => "Rejoignez une startup fintech innovante basée à Dakar et participez à la construction de solutions financières accessibles à tous. Vous concevrez et sécuriserez des API robustes, avec une forte culture d'ingénierie et les meilleures pratiques.",
        ],
        [
            'title' => 'Community manager',
            'location' => 'Dakar',
            'contract_type' => 'Freelance',
            'experience_level' => '1-2 ans',
            'skills' => ['Social media', 'Content', 'Photoshop', 'Instagram', 'Facebook'],
            'salary_min' => 150000,
            'salary_max' => 250000,
            'description' => "Mission freelance pour gérer la présence digitale d'une marque locale. Création de contenus, gestion communautaire et campagnes publicitaires sur les réseaux sociaux. Flexibilité et créativité requises.",
        ],
        [
            'title' => 'Web master & admin système',
            'location' => 'Dakar',
            'contract_type' => 'CDI',
            'experience_level' => '3-5 ans',
            'skills' => ['WordPress', 'SEO', 'Serveur', 'Linux', 'HTML/CSS'],
            'salary_min' => 280000,
            'salary_max' => 420000,
            'description' => "Maintenez et faites évoluer le site web de l'école ainsi que l'infrastructure serveur. Veille technologique, optimisation SEO et sécurisation des services. Poste en établissement éducatif à Dakar.",
        ],
        [
            'title' => 'Traducteur/interprète (français/wolof)',
            'location' => 'Dakar',
            'contract_type' => 'Temps partiel',
            'experience_level' => '3-5 ans',
            'skills' => ['Traduction', 'Interprétation', 'Wolof', 'Français', 'Rédaction'],
            'salary_min' => 200000,
            'salary_max' => 320000,
            'description' => "Poste à temps partiel pour traduire des contenus institutionnels et assurer l'interprétation lors d'événements officiels. Bilinguisme français/wolof et culture générale exigés.",
        ],
        [
            'title' => 'Technicien réseau & télécoms',
            'location' => 'Guediawaye',
            'contract_type' => 'CDI',
            'experience_level' => '1-2 ans',
            'skills' => ['Réseaux', 'Télécoms', 'Cisco', 'Fibre', 'Dépannage'],
            'salary_min' => 240000,
            'salary_max' => 360000,
            'description' => "Installez, configurez et réparez l'infrastructure réseau et télécoms de nos agences régionales. Interventions sur site et en déplacement dans la région de Guediawaye et alentours.",
        ],
        [
            'title' => 'Consultant RH',
            'location' => 'Dakar',
            'contract_type' => 'Freelance',
            'experience_level' => 'Expert',
            'skills' => ['RH', 'Recrutement', 'Formation', 'Paie', 'Management'],
            'salary_min' => 350000,
            'salary_max' => 520000,
            'description' => "Mission de conseil pour optimiser notre stratégie Ressources Humaines. Vous accompagnerez le recrutement, le développement des équipes et les politiques de rémunération.",
        ],
    ];

    public function run(): void
    {
        $companies = Company::all();
        foreach ($this->jobs as $job) {
            $company = $companies->random();
            Job::create([
                'company_id' => $company->id,
                'title' => $job['title'],
                'slug' => Str::slug($job['title'] . '-' . Str::random(6)),
                'location' => $job['location'],
                'contract_type' => $job['contract_type'],
                'experience_level' => $job['experience_level'],
                'salary_min' => $job['salary_min'],
                'salary_max' => $job['salary_max'],
                'skills_required' => $job['skills'],
                'description' => $job['description'],
                'is_active' => true,
                'posted_at' => now()->subDays(fake()->numberBetween(0, 20)),
            ]);
        }

        Job::factory(10)->create();
    }
}
