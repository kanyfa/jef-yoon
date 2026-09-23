@extends('layouts.app')

@section('title', 'Espace entreprise — Jëf & Yoon')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-deep-green mb-1">
                    {{ $company->name }}
                </h1>
                <p class="text-slate-600">{{ $company->sector ?? '' }} • {{ $company->location ?? '' }}</p>
            </div>
            <a href="{{ route('company.jobs.create') }}"
                class="bg-coral hover:bg-coral/90 text-white font-semibold px-4 py-2 rounded-md transition-colors">
                + Publier une offre
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-6xl">
    @include('components.flash')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-deep-green mb-1">{{ $stats['jobs'] }}</div>
            <div class="text-xs text-slate-500 uppercase">Offres publiées</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-gold mb-1">{{ $stats['applications'] }}</div>
            <div class="text-xs text-slate-500 uppercase">Candidatures reçues</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-center">
            <div class="text-3xl font-bold text-coral mb-1">
                @php
                    $pending = \App\Models\Application::whereIn('job_id', \App\Models\Job::where('company_id', $company->id)->pluck('id'))
                        ->where('status', 'pending')->count();
                @endphp
                {{ $pending }}
            </div>
            <div class="text-xs text-slate-500 uppercase">En attente</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-deep-green">Offres récentes</h2>
                <a href="{{ route('company.jobs.create') }}" class="text-sm text-gold hover:text-deep-green">Nouvelle offre →</a>
            </div>

            @if($jobs->isEmpty())
                <p class="text-slate-600">Aucune offre publiée pour le moment.</p>
            @else
                <div class="space-y-3">
                    @foreach($jobs as $job)
                        <div class="p-4 border border-slate-200 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-deep-green">{{ $job->title }}</h3>
                                    <p class="text-sm text-slate-600 mt-1">{{ $job->location }} • {{ $job->contract_type }}</p>
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach(array_slice($job->skills_required ?? [], 0, 4) as $skill)
                                            <span class="text-xs bg-slate-100 text-slate-600 px-1.5 py-0.5 rounded">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gold">{{ number_format($job->salary_min) }} FCFA</span>
                            </div>
                            <div class="mt-2 text-xs text-slate-500">
                                {{ $job->applications()->count() }} candidature(s)
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-deep-green">Candidatures récentes</h2>
                <a href="{{ route('company.applications') }}" class="text-sm text-gold hover:text-deep-green">Voir toutes →</a>
            </div>

            @if($recentApplications->isEmpty())
                <p class="text-slate-600">Aucune candidature pour le moment.</p>
            @else
                <div class="space-y-3">
                    @foreach($recentApplications as $app)
                        <div class="p-3 border border-slate-200 rounded-lg">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium text-deep-green">{{ $app->job->title }}</p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Candidature #{{ $app->id }} — {{ \App\Models\User::find($app->user_id)->name ?? 'Candidat' }}
                                    </p>
                                </div>
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
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
