@extends('layouts.app')

@section('title')
Accessibilité — {{ $job->title }}
@endsection

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-deep-green mb-2">Accessibilité du trajet</h1>
        <p class="text-slate-600">
            Calcul de l'accessibilité pour le poste de <strong>{{ $job->title }}</strong>
            basé(e) à <strong>{{ $job->location }}</strong>.
        </p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-10">
        <main>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                    <div class="p-4">
                        <div class="text-2xl font-bold text-deep-green mb-1">8.4 km</div>
                        <div class="text-xs text-slate-500">Distance (centre à centre)</div>
                    </div>
                    <div class="p-4 border-l sm:border-l-0 sm:border-t sm:sm:border-t-0 border-slate-200">
                        <div class="text-2xl font-bold text-gold mb-1">~30 min</div>
                        <div class="text-xs text-slate-500">Temps de trajet moyen</div>
                    </div>
                    <div class="p-4 border-l sm:border-l-0 border-slate-200">
                        <div class="text-2xl font-bold text-coral mb-1">1 200 FCFA</div>
                        <div class="text-xs text-slate-500">Coût estimé (taxi)</div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-200">
                    <div class="bg-deep-green/5 rounded-lg p-4 mb-4">
                        <p class="text-sm text-slate-700">
                            <strong class="text-deep-green">Départ :</strong> {{ $origin }}
                            &nbsp;&nbsp;→&nbsp;&nbsp;
                            <strong class="text-deep-green">Destination :</strong> {{ $destination }}
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-100">
                                <tr>
                                    <th class="text-left py-2.5 px-3">Mode de transport</th>
                                    <th class="text-left py-2.5 px-3">Temps estimé</th>
                                    <th class="text-left py-2.5 px-3">Coût estimé</th>
                                    <th class="text-left py-2.5 px-3">Disponibilité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transportModes as $mode)
                                    <tr class="border-b border-slate-200 last:border-0">
                                        <td class="py-2 px-3 font-medium">{{ $mode['name'] }}</td>
                                        <td class="py-2 px-3">{{ $mode['estimated_time'] }}</td>
                                        <td class="py-2 px-3">{{ $mode['estimated_cost'] }}</td>
                                        <td class="py-2 px-3 text-xs text-slate-500">{{ $mode['description'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h2 class="text-xl font-bold text-deep-green mb-4">Carte du trajet</h2>
                <p class="text-sm text-slate-600 mb-4">
                    Itinéraire stylisé entre <strong>{{ $origin }}</strong> et <strong>{{ $destination }}</strong>.
                    Cliquez sur les étapes pour plus de détails.
                </p>

                <div id="route-map" class="relative w-full bg-slate-50 rounded-lg border border-slate-200 overflow-hidden">
                    @include('components.route-map')
                </div>

                <div class="mt-4 grid sm:grid-cols-2 gap-4 text-sm text-slate-600">
                    <div class="bg-cream p-3 rounded-md border border-slate-200">
                        <strong class="text-deep-green">Astuce :</strong> Les temps affichés sont des moyennes calculées sur la base des flux quotidiens. Prévoyez un coussin de 10 à 20 minutes en heure de pointe.
                    </div>
                    <div class="bg-cream p-3 rounded-md border border-slate-200">
                        <strong class="text-deep-green">Conseil :</strong> Les motos-taxis (Jendeut) sont nombreux dans les quartiers denses. Privilégiez les services régulés pour plus de sécurité.
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-coral/5 border border-coral/20 rounded-lg p-5">
                <h3 class="font-bold text-coral mb-2">⚠️ Avertissement important</h3>
                <p class="text-sm text-slate-700">
                    Les distances, durées et coûts de transport affichés sur cette page sont des
                    <strong>estimations indicatives</strong> basées sur des données moyennes et ne reflètent pas
                    des calculs en temps réel. Ils sont fournis à titre informatif et ne constituent pas
                    des données fiables pour la prise de décision. Consultez toujours les services de
                    transport locaux et vérifiez les horaires et tarifs officiels avant de vous déplacer.
                    Jëf &amp; Yoon ne garantit en aucun cas l'exactitude de ces estimations et ne saurait
                    être tenu responsable des retards ou désagréments liés à votre trajet.
                </p>
            </div>
        </main>

        <aside class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-deep-green/10 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-deep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h7m-7 0V9a5 5 0 10-5 5h5l-2-2"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-deep-green">Postulez maintenant</h3>
                </div>
                <p class="text-sm text-slate-600 mb-4">Vous êtes convaincu(e) ? Postulez en quelques clics.</p>
                <a href="{{ route('applications.create', $job->slug) }}"
                    class="block w-full bg-coral hover:bg-coral/90 text-white font-semibold py-2.5 rounded-md text-center transition-colors">
                    Postuler à cette offre
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-semibold text-deep-green mb-4">Entreprise</h3>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center overflow-hidden">
                        <span class="text-lg">{{ mb_substr($job->company->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-deep-green">{{ $job->company->name }}</p>
                        <p class="text-xs text-slate-500">{{ $job->company->sector ?? 'Entreprise' }}</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
