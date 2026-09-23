@extends('layouts.app')

@section('title', 'Inscription — Jëf & Yoon')

@section('content')
<div class="min-h-screen bg-cream flex items-center justify-center py-12">
    <div class="w-full max-w-lg bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <div class="flex items-center justify-center space-x-2 text-2xl font-bold text-deep-green mb-2">
                <span>🧡</span>
                <span>Jëf &amp; Yoon</span>
            </div>
            <h1 class="text-xl font-semibold text-deep-green">Créer votre compte</h1>
            <p class="text-sm text-slate-600 mt-1">Rejoignez la communauté Jëf &amp; Yoon et démarrez votre recherche d'emploi ou publiez vos offres.</p>
        </div>

        <div class="flex justify-center mb-6 border border-slate-200 rounded-md p-1 bg-slate-50">
            <button type="button" onclick="setRole('candidate')" id="btn-candidate"
                class="flex-1 py-2 rounded-md bg-deep-green text-white text-sm font-semibold transition-all">
                Candidat
            </button>
            <button type="button" onclick="setRole('company')" id="btn-company"
                class="flex-1 py-2 rounded-md text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-all">
                Entreprise
            </button>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="role" id="role-input" value="candidate">

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Adresse e-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                </div>

                <div id="location-field" class="hidden">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Localisation (optionnel pour entreprise)</label>
                    <input type="text" name="location" list="locations-register" value="{{ old('location') }}"
                        class="w-fill px-4 py-2.5 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                    <datalist id="locations-register">
                        @foreach(['Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Thiadiaye', 'Yoff', 'Ouakam', 'Mermoz', 'Diourbel', 'Louga'] as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Mot de passe</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2.5 pr-10 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                    <button type="button" onclick="togglePassword('password')"
                        style="top: 28px;"
                        class="absolute right-3 text-slate-500 hover:text-slate-700 focus:outline-none"
                        aria-label="Afficher le mot de passe">
                        <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s8-7 11-7 11 7 11 7-8 7-11 7-11-7-11z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-2.5 pr-10 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                        style="top: 28px;"
                        class="absolute right-3 text-slate-500 hover:text-slate-700 focus:outline-none"
                        aria-label="Afficher le mot de passe">
                        <svg id="eye-password_confirmation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s8-7 11-7 11 7 11 7-8 7-11 7-11-7-11z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-coral hover:bg-coral/90 text-white font-semibold py-2.5 rounded-md transition-colors">
                S'inscrire en tant que <span id="role-label">Candidat</span>
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-slate-600">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="font-medium text-deep-green hover:text-gold">Connectez-vous</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword(id){
  const input = document.getElementById(id);
  const icon = document.getElementById('eye-' + id);
  if(!input || !icon) return;
  if(input.type === 'password'){
    input.type = 'text';
    icon.innerHTML = '<path d="M17.94 17.94A4.14 4.14 0 0 1 12 15.5a4.14 4.14 0 0 1-2.15-.62"/><path d="M1 1l22 22"/><path d="M4.56 4.56A9.95 9.95 0 0 1 1 12s3.25 6 11 6 8.44-3.51A9.95 9.95 0 0 0 19.44 19.44z"/><line x1="12" y1="12" x2="12" y2="12"/>';
  } else {
    input.type = 'password';
    icon.innerHTML = '<path d="M1 12s8-7 11-7 11 7 11 7-8 7-11 7-11-7-11z"/><circle cx="12" cy="12" r="3"/>';
  }
}

    function setRole(role) {
        document.getElementById('role-input').value = role;
        document.getElementById('role-label').textContent = role === 'candidate' ? 'Candidat' : 'Entreprise';
        var btnC = document.getElementById('btn-candidate');
        var btnE = document.getElementById('btn-company');
        var locField = document.getElementById('location-field');

        if (role === 'candidate') {
            btnC.className = 'flex-1 py-2 rounded-md bg-deep-green text-white text-sm font-semibold transition-all';
            btnE.className = 'flex-1 py-2 rounded-md text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-all';
            locField.classList.remove('hidden');
        } else {
            btnE.className = 'flex-1 py-2 rounded-md bg-deep-green text-white text-sm font-semibold transition-all';
            btnC.className = 'flex-1 py-2 rounded-md text-slate-600 text-sm font-semibold hover:bg-slate-200 transition-all';
            locField.classList.add('hidden');
        }
    }
</script>
@endsection
