@extends('layouts.app')

@section('title')
{{ $job->title }} — Jëf &amp; Yoon
@endsection

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-xs font-medium bg-deep-green/10 text-deep-green px-2 py-1 rounded">
                    {{ $job->contract_type }}
                </span>
                <span class="text-xs text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                    {{ $job->experience_level }}
                </span>
                @if($job->posted_at)
                    <span class="text-xs text-slate-400">Publiée {{ $job->posted_at->diffForHumans() }}</span>
                @endif
            </div>

            <h1 class="text-3xl font-bold text-deep-green mb-2">{{ $job->title }}</h1>
            <div class="flex items-center text-slate-600 mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 10.25h0M17.25 10.25h0M5.25 5.25a2.25 2.25 0003.952L12 8.5l6.75-3.25a2.25 2.25 0 013.2 2.1V15a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V7.75z"/>
                </svg>
                {{ $job->company->name }} • {{ $job->location }}
            </div>

            <div class="text-2xl font-bold text-gold mb-6">
                {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} FCFA / mois
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-10">
        <main>
            <div class="prose prose-slate max-w-none mb-10">
                <h2 class="text-deep-green">Description du poste</h2>
                {!! nl2br(e($job->description)) !!}
            </div>

            <div class="mb-10">
                <h2 class="text-deep-green mb-4">Compétences requises</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($job->skills_required ?? [] as $skill)
                        <span class="px-3 py-1.5 bg-deep-green/10 text-deep-green rounded-full text-sm font-medium">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-slate-200 pt-8 mb-10">
                <h2 class="text-deep-green mb-4">Offres similaires</h2>
                @if($relatedJobs->isEmpty())
                    <p class="text-slate-600">Aucune offre similaire pour le moment.</p>
                @else
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($relatedJobs as $related)
                            <a href="{{ route('jobs.show', $related->slug) }}" class="block bg-cream border border-slate-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
                                <h3 class="font-semibold text-deep-green">{{ $related->title }}</h3>
                                <p class="text-sm text-slate-600">{{ $related->company->name }} • {{ $related->location }}</p>
                                <p class="text-sm text-gold font-medium">{{ number_format($related->salary_min) }} FCFA</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>

        <aside class="space-y-6">
            <div class="bg-cream rounded-lg p-6">
                <h3 class="font-bold text-deep-green mb-4">Accessibilité du trajet</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Distance</span>
                        <span class="font-medium">{{ $access['distance'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Temps estimé</span>
                        <span class="font-medium">{{ $access['estimated_time'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Coût estimé</span>
                        <span class="font-medium">{{ $access['estimated_cost'] }}</span>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-medium text-slate-500">Modes de transport</span>
                    </div>
                    <div class="space-y-2">
                        @foreach($access['modes'] as $mode)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">{{ $mode['mode'] }}</span>
                                <span class="text-slate-500">{{ $mode['cost'] }} · {{ $mode['time'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <p class="text-xs text-slate-500 mt-3">
                    <strong class="text-coral">!</strong> Ces données sont indicatives.
                </p>
                <a href="{{ route('jobs.accessibility', $job->slug) }}" class="mt-4 block w-full text-center bg-deep-green hover:bg-deep-green-800 text-white font-semibold py-2.5 rounded-md text-sm transition-colors">
                    Voir carte &amp; trajet
                </a>
            </div>

            <div class="text-center">
                @if(auth()->check() && auth()->user()->isCandidate())
                    <a href="{{ route('applications.create', $job->slug) }}" class="block w-full bg-coral hover:bg-coral/90 text-white font-semibold py-3 rounded-md transition-colors">
                        Postuler maintenant
                    </a>
                @elseif(auth()->check() && auth()->user()->isCompany())
                    <a href="{{ route('company.dashboard') }}" class="block w-full bg-coral hover:bg-coral/90 text-white font-semibold py-3 rounded-md transition-colors">
                        Publier une offre similaire
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block w-full bg-coral hover:bg-coral/90 text-white font-semibold py-3 rounded-md transition-colors">
                        Postuler maintenant
                    </a>
                @endif
                <p class="text-xs text-slate-500 mt-2">
                    En postulant, vous acceptez nos conditions.
                </p>
            </div>
        </aside>
    </div>
</div>
@endsection
