@extends('layouts.app')

@section('title', 'Offres d\'emploi — Jëf & Yoon')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-deep-green mb-2">Offres d'emploi</h1>
        <p class="text-slate-600">Trouvez l'offre qui correspond à votre profil parmi {{ $jobs->total() }} annonces.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-8">
        <aside class="lg:col-span-1">
            <form method="GET" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Mot-clé</label>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Ex: développeur, marketing..."
                        class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Localisation</label>
                    <input type="text" name="location" list="loc-list" value="{{ request('location') }}" placeholder="Toutes les localisations"
                        class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                    <datalist id="loc-list">
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Type de contrat</label>
                    <select name="contract_type" class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                        <option value="">Tous</option>
                        @foreach($contractTypes as $type)
                            <option value="{{ $type }}" {{ request('contract_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Niveau d'expérience</label>
                    <select name="experience_level" class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                        <option value="">Tous</option>
                        @foreach($experienceLevels as $level)
                            <option value="{{ $level }}" {{ request('experience_level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Compétence</label>
                    <input type="text" name="skill" value="{{ request('skill') }}" placeholder="Ex: PHP, Laravel..."
                        class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Trier par</label>
                    <select name="sort" onchange="this.form.submit()" class="w-full px-3 py-2 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                        <option value="date_desc" {{ $sort == 'date_desc' ? 'selected' : '' }}>Plus récent</option>
                        <option value="date_asc" {{ $sort == 'date_asc' ? 'selected' : '' }}>Plus ancien</option>
                        <option value="salary_desc" {{ $sort == 'salary_desc' ? 'selected' : '' }}>Salaire ↑</option>
                        <option value="salary_asc" {{ $sort == 'salary_asc' ? 'selected' : '' }}>Salaire ↓</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-deep-green hover:bg-deep-green-800 text-white font-semibold py-2.5 rounded-md transition-colors">
                    Appliquer les filtres
                </button>
            </form>
        </aside>

        <main>
            @if($jobs->isEmpty())
                <div class="text-center py-12">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <p class="text-slate-600 mb-4">Aucune offre ne correspond à votre recherche.</p>
                    <a href="{{ route('jobs.index') }}" class="text-deep-green font-medium hover:text-gold">Effacer les filtres</a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($jobs as $job)
                        <a href="{{ route('jobs.show', $job->slug) }}" class="block bg-white rounded-lg shadow-sm border border-slate-200 hover:shadow-md hover:border-deep-green/20 transition-all">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-xs font-medium bg-deep-green/10 text-deep-green px-2 py-1 rounded">
                                            {{ $job->contract_type }}
                                        </span>
                                        <span class="text-xs text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                            {{ $job->experience_level }}
                                        </span>
                                        @if($job->posted_at)
                                            <span class="text-xs text-slate-400">
                                                {{ $job->posted_at->diffForHumans() }}
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-sm font-bold text-gold">
                                        {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} FCFA
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg text-deep-green mb-1">{{ $job->title }}</h3>
                                <p class="text-sm text-slate-600 mb-2">{{ $job->company->name }} • {{ $job->location }}</p>
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach($job->skills_required ?? [] as $skill)
                                        <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded">{{ $skill }}</span>
                                    @endforeach
                                </div>
                                <p class="text-sm text-slate-600 line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($job->description), 160) }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $jobs->links() }}
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
