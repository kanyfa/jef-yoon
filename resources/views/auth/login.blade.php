@extends('layouts.app')

@section('title', 'Connexion — Jëf & Yoon')

@section('content')
<div class="min-h-screen bg-cream flex items-center justify-center py-12">
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <div class="text-center mb-6">
            <div class="flex items-center justify-center space-x-2 text-2xl font-bold text-deep-green mb-2">
                <span>🧡</span>
                <span>Jëf &amp; Yoon</span>
            </div>
            <h1 class="text-xl font-semibold text-deep-green">Connexion à votre compte</h1>
            <p class="text-sm text-slate-600 mt-1">Accédez à votre tableau de bord et suivez vos candidatures.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Adresse e-mail</label>
                <input
                    type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2.5 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green"
                />
            </div>

            <div class="relative mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Mot de passe</label>
                <input id="password"
                    type="password" name="password" required
                    class="w-full px-4 py-2.5 pr-10 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green"
                />
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

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-deep-green focus:ring-deep-green">
                    Se souvenir de moi
                </label>
                <a href="#" class="text-sm text-gold hover:text-deep-green">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="w-full bg-deep-green hover:bg-deep-green-800 text-white font-semibold py-2.5 rounded-md transition-colors">
                Se connecter
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-slate-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="font-medium text-deep-green hover:text-gold">Inscrivez-vous gratuitement</a>
            </p>
        </div>

        <div class="mt-4 text-center">
            <div class="text-xs text-slate-400 my-2">ou continuez avec un compte de test</div>
            <div class="flex gap-2 text-xs">
                <a href="{{ route('login') }}" class="flex-1 text-center px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-md">candidate@jejyoon.sn</a>
                <a href="{{ route('login') }}" class="flex-1 text-center px-3 py-1.5 bg-slate-100 border border-slate-200 rounded-md">company@jejyoon.sn</a>
            </div>
             <p class="text-xs text-slate-400 mt-1">Mot de passe : <code class="bg-slate-100 px-1 rounded">password</code></p>
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
</script>
@endsection
