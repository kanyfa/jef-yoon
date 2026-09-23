@php
    $isAuth = auth()->check();
    $isCompany = $isAuth && auth()->user()->isCompany();
    $isCandidate = $isAuth && auth()->user()->isCandidate();
@endphp

<header class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-30">
    <div class="container mx-auto px-4">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 text-xl font-bold text-deep-green hover:text-gold transition-colors">
                    <span class="text-2xl">🧡</span>
                    <span>Jëf &amp; Yoon</span>
                </a>
                <nav class="hidden md:flex space-x-6 text-sm font-medium">
                    <a href="{{ route('jobs.index') }}" class="{{ request()->routeIs('jobs.*') ? 'text-deep-green' : 'text-slate-600 hover:text-deep-green' }} transition-colors">Offres d'emploi</a>
                    @if($isCandidate)
                        <a href="{{ route('candidate.dashboard') }}" class="{{ request()->routeIs('candidate.dashboard') ? 'text-deep-green' : 'text-slate-600 hover:text-deep-green' }} transition-colors">Tableau de bord</a>
                        <a href="{{ route('candidate.profile') }}" class="{{ request()->routeIs('candidate.profile') ? 'text-deep-green' : 'text-slate-600 hover:text-deep-green' }} transition-colors">Mon profil</a>
                    @endif
                    @if($isCompany)
                        <a href="{{ route('company.dashboard') }}" class="{{ request()->routeIs('company.dashboard') ? 'text-deep-green' : 'text-slate-600 hover:text-deep-green' }} transition-colors">Espace entreprise</a>
                    @endif
                </nav>
            </div>

            <div class="flex items-center space-x-4">
                @if(session('success'))
                    <div class="text-sm text-deep-green font-medium animate-pulse">
                        {{ session('success') }}
                    </div>
                @endif

                @if($isAuth)
                    <span class="hidden md:block text-sm text-slate-600">
                        Bonjour, {{ explode(' ', auth()->user()->name)[0] ?? 'Utilisateur' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-slate-600 hover:text-deep-green transition-colors">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hidden md:inline-block text-sm font-medium text-slate-600 hover:text-deep-green transition-colors">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center rounded-md bg-deep-green px-4 py-2 text-sm font-semibold text-white hover:bg-deep-green-800 transition-colors">
                        S'inscrire
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
