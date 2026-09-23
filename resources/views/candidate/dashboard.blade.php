@extends('layouts.app')

@section('title', 'Tableau de bord — Jëf & Yoon')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-deep-green mb-1">
            Bonjour, {{ explode(' ', auth()->user()->name)[0] ?? 'Moussa' }}
        </h1>
        <p class="text-slate-600">Suivez vos candidatures et gérez votre profil.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-6xl">
    @include('components.flash')

    @if(!$candidate)
        <div class="bg-coral/5 border border-coral/20 rounded-lg p-6 mb-8">
            <h2 class="font-bold text-coral mb-2">Profil incomplet</h2>
            <p class="text-sm text-slate-700 mb-4">
                Votre profil candidat n'est pas encore créé. Complétez-le pour postuler plus efficacement.
            </p>
            <a href="{{ route('candidate.profile') }}"
                class="inline-block bg-deep-green hover:bg-deep-green-800 text-white font-semibold px-4 py-2 rounded-md transition-colors">
                Créer mon profil
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-deep-green mb-1">{{ $stats['total'] }}</div>
            <div class="text-xs text-slate-500 uppercase">Candidatures totales</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-gold mb-1">{{ $stats['pending'] }}</div>
            <div class="text-xs text-slate-500 uppercase">En attente</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-coral mb-1">{{ $stats['accepted'] }}</div>
            <div class="text-xs text-slate-500 uppercase">Acceptées</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-slate-600 mb-1">{{ $stats['reviewed'] }}</div>
            <div class="text-xs text-slate-500 uppercase">En revue</div>
        </div>
    </div>

    @if($candidate)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-deep-green">Votre profil</h2>
                <a href="{{ route('candidate.profile') }}"
                    class="text-sm text-gold hover:text-deep-green">
                    Modifier →
                </a>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div>
                        <span class="text-xs text-slate-500">Nom</span>
                        <p class="font-medium">{{ $candidate->first_name . ' ' . $candidate->last_name }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-slate-500">Localisation</span>
                        <p class="font-medium">{{ $candidate->location ?? 'Non renseignée' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-slate-500">Niveau</span>
                        <p class="font-medium">{{ $candidate->level ?? 'Non renseigné' }}</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div>
                        <span class="text-xs text-slate-500">Contrat souhaité</span>
                        <p class="font-medium">{{ $candidate->contract_type_preference ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-slate-500">Compétences</span>
                        <div class="flex flex-wrap gap-1 mt-1">
                            @foreach(array_slice($candidate->skills ?? [], 0, 8) as $skill)
                                <span class="text-xs bg-deep-green/10 text-deep-green px-2 py-0.5 rounded">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <span class="text-xs text-slate-500">CV</span>
                        <p class="font-medium">
                            @if($candidate->cv_path)
                                <a href="#" class="text-deep-green hover:underline">Téléchargé</a>
                            @else
                                <span class="text-slate-400">Non téléchargé</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-deep-green">Mes candidatures récentes</h2>
            <a href="{{ route('jobs.index') }}"
                class="text-sm text-gold hover:text-deep-green">
                Trouver d'autres offres →
            </a>
        </div>

        @if($applications->isEmpty())
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v4"/>
                </svg>
                <p class="text-slate-600 mb-4">Vous n'avez pas encore postulé.</p>
                <a href="{{ route('jobs.index') }}"
                    class="inline-block bg-coral hover:bg-coral/90 text-white font-semibold px-4 py-2 rounded-md transition-colors">
                    Parcourir les offres
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="text-left py-2.5 px-3 font-medium text-deep-green">Offre</th>
                            <th class="text-left py-2.5 px-3 font-medium text-deep-green">Entreprise</th>
                            <th class="text-left py-2.5 px-3 font-medium text-deep-green">Statut</th>
                            <th class="text-left py-2.5 px-3 font-medium text-deep-green">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $app)
                            <tr class="border-b border-slate-200 last:border-0">
                                <td class="py-2 px-3">
                                    <a href="{{ route('jobs.show', $app->job->slug) }}" class="font-medium text-deep-green hover:text-gold">{{ $app->job->title }}</a>
                                </td>
                                <td class="py-2 px-3 text-slate-600">{{ $app->job->company->name ?? 'N/A' }}</td>
                                <td class="py-2 px-3">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-gold/10 text-gold',
                                            'reviewed' => 'bg-deep-green/10 text-deep-green',
                                            'accepted' => 'bg-coral/10 text-coral',
                                            'rejected' => 'bg-slate-400/10 text-slate-500',
                                        ];
                                        $color = $statusColors[$app->status] ?? 'bg-slate-100 text-slate-600';
                                    @endphp
                                    <span class="px-2 py-0.5 text-xs rounded {{ $color }}">
                                        {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                    </span>
                                </td>
                                <td class="py-2 px-3 text-slate-500">{{ $app->applied_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
