<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AccessibilityController extends Controller
{
    public function __invoke(Request $request, Job $job)
    {
        if (! $job->is_active) {
            abort(404);
        }

        $job->load('company');

        $origin = $request->query('from', 'Dakar, Sénégal');
        $destination = $job->location . ', Sénégal';

        $places = [
            'Dakar' => ['lat' => 14.7157, 'lng' => -17.4677],
            'Pikine' => ['lat' => 14.7142, 'lng' => -17.4456],
            'Guediawaye' => ['lat' => 14.7827, 'lng' => -17.4364],
            'Rufisque' => ['lat' => 14.6589, 'lng' => -17.1929],
            'Thiadiaye' => ['lat' => 15.0343, 'lng' => -17.2388],
            'Yoff' => ['lat' => 14.7392, 'lng' => -17.4686],
            'Ouakam' => ['lat' => 14.7333, 'lng' => -17.4833],
            'Mermoz' => ['lat' => 14.7167, 'lng' => -17.4500],
            'Diourbel' => ['lat' => 14.6929, 'lng' => -17.2731],
            'Louga' => ['lat' => 16.2800, 'lng' => -16.3300],
        ];

        $transportModes = [
            [
                'name' => 'Taxi urbain',
                'icon' => 'taxi',
                'estimated_time' => '28 min',
                'estimated_cost' => '2 800 FCFA',
                'description' => "Trajets en taxi partagé ou privé disponible 24h/24. Le prix varie selon la distance et la demande.",
            ],
            [
                'name' => 'Car (bus)',
                'icon' => 'bus',
                'estimated_time' => '55 min',
                'estimated_cost' => '250 FCFA',
                'description' => "Réseaux de transport en commun desservant les principales artères de la région de Dakar.",
            ],
            [
                'name' => 'Moto-taxi',
                'icon' => 'motorcycle',
                'estimated_time' => '18 min',
                'estimated_cost' => '1 600 FCFA',
                'description' => "Rapidité maximale pour les trajets urbains courts. Idéal en milieu dense.",
            ],
            [
                'name' => 'Vélo',
                'icon' => 'bike',
                'estimated_time' => '40 min',
                'estimated_cost' => '0 FCFA',
                'description' => "Option écologique pour les trajets de moins de 8 km, idéale pour la santé.",
            ],
            [
                'name' => 'Marche à pied',
                'icon' => 'walk',
                'estimated_time' => '1h10',
                'estimated_cost' => '0 FCFA',
                'description' => "Option la plus économique, adaptée aux trajets courts et pour la mobilité active.",
            ],
        ];

        return view('accessibility.index', [
            'job' => $job,
            'origin' => $origin,
            'destination' => $destination,
            'places' => $places,
            'placeKeys' => array_keys($places),
            'transportModes' => $transportModes,
        ]);
    }
}
