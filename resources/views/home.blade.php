@extends('layouts.app')

@section('title', 'Jëf & Yoon — Emploi au Sénégal')
@section('description', "Jëf & Yoon : la plateforme d'emploi qui vous connecte aux opportunités au Sénégal. Trouvez l'offre qui vous convient et vérifiez l'accessibilité de votre trajet domicile-travail.")

@section('content')
    <section class="bg-gradient-to-b from-deep-green to-deep-green-800 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    Trouvez l'emploi <span class="text-gold">qu'il vous convient</span> au Sénégal
                </h1>
                <p class="text-lg opacity-90 mb-8">
                    Jëf &amp; Yoon vous met en relation avec des offres d'emploi dans toute la région de Dakar.
                    Comparez les opportunités, vérifiez l'accessibilité de votre trajet et postulez en toute simplicité.
                </p>

                <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input
                        type="text" name="keyword" placeholder="Intitulé du poste, compétence..."
                        class="flex-grow px-4 py-3 rounded-md text-slate-800 focus:outline-none focus:ring-2 focus:ring-gold"
                    />
                    <input
                        type="text" name="location" placeholder="Localisation (ex: Dakar, Pikine...)"
                        list="locations-home"
                        class="flex-grow px-4 py-3 rounded-md text-slate-800 focus:outline-none focus:ring-2 focus:ring-gold"
                    />
                    <button type="submit"
                        class="bg-coral hover:bg-coral/90 text-white font-semibold px-6 py-3 rounded-md transition-colors">
                        Rechercher
                    </button>
                </form>

                <datalist id="locations-home">
                    @foreach(['Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Thiadiaye', 'Yoff', 'Ouakam', 'Mermoz', 'Diourbel', 'Louga'] as $loc)
                        <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </datalist>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-deep-green mb-3">Pourquoi choisir Jëf &amp; Yoon ?</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Une plateforme pensée pour le Sénégal, qui va au-delà de la simple recherche d'emploi en ajoutant l'accessibilité.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg bg-cream border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-deep-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-deep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-deep-green mb-2">Recherche ciblée</h3>
                    <p class="text-sm text-slate-600">Filtrez par métier, localisation, type de contrat et niveau d'expérience.</p>
                </div>

                <div class="text-center p-6 rounded-lg bg-cream border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-deep-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-deep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-deep-green mb-2">Accessibilité</h3>
                    <p class="text-sm text-slate-600">Calculez distance, temps et coût du trajet domicile-travail avant de postuler.</p>
                </div>

                <div class="text-center p-6 rounded-lg bg-cream border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 bg-deep-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-deep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4 .89-4 2v4c0 1.1.68 2 1.5 2h5c.82 0 1.5-.9 1.5-2v-4c0-1.1-.78-2-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-deep-green mb-2">Candidature simple</h3>
                    <p class="text-sm text-slate-600">Postulez en un clic avec votre profil et suivez l'état de votre candidature.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-cream">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-deep-green">Offres vedettes</h2>
                <a href="{{ route('jobs.index') }}" class="text-sm font-medium text-deep-green hover:text-gold transition-colors">
                    Voir toutes les offres →
                </a>
            </div>

            @if($featuredJobs->isEmpty())
                <p class="text-slate-600">Aucune offre disponible pour le moment.</p>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredJobs as $job)
                        <a href="{{ route('jobs.show', $job->slug) }}" class="block bg-white rounded-lg shadow-sm border border-slate-200 hover:shadow-md hover:-translate-y-1 transition-all">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="text-xs font-medium bg-deep-green/10 text-deep-green px-2 py-1 rounded">
                                        {{ $job->contract_type }}
                                    </span>
                                    <span class="text-xs text-slate-500">{{ $job->experience_level }}</span>
                                </div>
                                <h3 class="font-bold text-lg text-deep-green mb-1">{{ $job->title }}</h3>
                                <p class="text-sm text-slate-600 mb-3">{{ $job->company->name }} • {{ $job->location }}</p>
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach(array_slice($job->skills_required ?? [], 0, 3) as $skill)
                                        <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded">{{ $skill }}</span>
                                    @endforeach
                                </div>
                                <div class="text-sm font-semibold text-gold">
                                    {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} FCFA
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="py-12 bg-deep-green text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Prêt à trouver votre prochain emploi ?</h2>
            <p class="opacity-90 mb-6">Créez votre profil et postulez aux offres qui correspondent à vos attentes.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register', ['role' => 'candidate']) }}" class="bg-coral hover:bg-coral/90 text-white font-semibold px-6 py-3 rounded-md transition-colors">
                    Candidat — S'inscrire
                </a>
                <a href="{{ route('register', ['role' => 'company']) }}" class="bg-white text-deep-green font-semibold px-6 py-3 rounded-md hover:bg-cream transition-colors">
                    Entreprise — Créer un compte
                </a>
            </div>
        </div>
    </section>

    <section class="py-10 bg-slate-100">
        <div class="container mx-auto px-4 text-center text-xs text-slate-500">
            <p class="mb-2">
                <strong>Note :</strong> Les distances, temps et coûts de transport affichés sur Jëf &amp; Yoon sont des
                <u className="underline">estimations indicatives</u> et ne reflètent pas des données en temps réel.
                Consultez les services de transport locaux pour des informations précises.
            </p>
            <p>&copy; 2025 Jëf &amp; Yoon — Dakar, Sénégal</p>
        </div>
    </section>
@endsection
