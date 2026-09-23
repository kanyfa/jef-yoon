@extends('layouts.app')

@section('title')
Postuler — {{ $job->title }}
@endsection

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl">
            <h1 class="text-2xl font-bold text-deep-green mb-2">Candidature pour {{ $job->title }}</h1>
            <p class="text-slate-600">Chez {{ $job->company->name }} • {{ $job->location }}</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-10">
        <main>
            <form method="POST" action="{{ route('applications.store', $job->slug) }}" class="space-y-6">
                @csrf

                <div class="bg-cream/30 border border-slate-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center overflow-hidden">
                            <span class="text-lg">{{ mb_substr($job->company->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-deep-green">{{ $job->company->name }}</p>
                            <p class="text-sm text-slate-600">{{ $job->location }} • {{ $job->contract_type }}</p>
                        </div>
                    </div>
                </div>

                @if($candidate && $candidate->bio)
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Bio (proposée depuis votre profil)</label>
                        <div class="p-3 bg-white border border-slate-200 rounded-md text-sm text-slate-600 min-h-[60px]">
                            {{ $candidate->bio }}
                        </div>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Lettre de motivation *
                    </label>
                    <textarea
                        name="motivation"
                        rows="8"
                        required
                        minlength="100"
                        maxlength="2000"
                        placeholder="Expliquez pourquoi vous postulez à ce poste et ce que vous apporterez à l'équipe..."
                        class="w-full px-4 py-3 rounded-md border border-slate-300 focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green resize-y"
                    >{{ old('motivation', $candidate && $candidate->bio ? "Bonjour,\n\nJe suis intéressé(e) par le poste de {$job->title} chez {$job->company->name}. Ma Bio : {$candidate->bio}\n\nCordialement" : '') }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">
                        Minimum 100 caractères, maximum 2000 caractères.
                    </p>
                </div>

                @if($candidate && $candidate->cv_path)
                    <div class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-md">
                        <svg class="w-5 h-5 text-deep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v4"/>
                        </svg>
                        <span class="text-sm text-slate-600">CV joint depuis votre profil.</span>
                    </div>
                @else
                    <div class="flex items-center gap-3 p-3 bg-cream border border-slate-200 rounded-md text-sm text-slate-600">
                        <svg class="w-5 h-5 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.77 2.33 1.28 1.28a1 1 0 0 0 1.42 0L12 15l4.29 4.29a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 0-1.42l-1.28-1.28A9 9 0 0 0 16 7.5a9 9 0 0 0-1.76 7.77z"/>
                        </svg>
                        <span>Aucun CV n'est lié à votre profil. Vous pouvez le télécharger depuis votre profil candidat.</span>
                    </div>
                @endif

                <div class="flex items-center pt-4 border-t border-slate-200">
                    <input type="checkbox" id="confirm" class="mr-2 rounded border-slate-300 text-deep-green focus:ring-deep-green" required>
                    <label for="confirm" class="text-sm text-slate-700">
                        Je confirme que les informations fournies sont exactes et souhaite postuler à cette offre.
                    </label>
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('jobs.show', $job->slug) }}" class="text-sm text-slate-600 hover:text-deep-green transition-colors">
                        ← Retour à l'offre
                    </a>
                    <button type="submit"
                        class="bg-coral hover:bg-coral/90 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
                        Envoyer ma candidature
                    </button>
                </div>
            </form>
        </main>

        <aside>
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-5 text-sm text-slate-600 space-y-3">
                <h3 class="font-semibold text-deep-green mb-3">Récapitulatif</h3>
                <div class="pb-2 border-b border-slate-200">
                    <span class="font-medium text-slate-700">Poste :</span> {{ $job->title }}
                </div>
                <div class="pb-2 border-b border-slate-200">
                    <span class="font-medium text-slate-700">Entreprise :</span> {{ $job->company->name }}
                </div>
                <div class="pb-2 border-b border-slate-200">
                    <span class="font-medium text-slate-700">Localisation :</span> {{ $job->location }}
                </div>
                <div class="pb-2 border-b border-slate-200">
                    <span class="font-medium text-slate-700">Contrat :</span> {{ $job->contract_type }}
                </div>
                <div class="pb-2 border-b border-slate-200">
                    <span class="font-medium text-slate-700">Salaire :</span> {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} FCFA
                </div>
                <div>
                    <span class="font-medium text-slate-700">Compétences :</span>
                    <div class="mt-1 flex flex-wrap gap-1">
                        @foreach($job->skills_required ?? [] as $skill)
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
