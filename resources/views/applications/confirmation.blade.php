@extends('layouts.app')

@section('title', 'Candidature envoyée — Jëf & Yoon')

@section('content')
<div class="min-h-screen bg-cream flex items-center justify-center py-16">
    <div class="w-full max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center">
            <div class="w-20 h-20 bg-deep-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-deep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.617 4.487a2 2 0 01-1.414 2.827L13 17.5l-4-4 0 0 0 0 0l-2.5-2.5a2 2 0 010-2.826l.214-.213a2 2 0 012.828 0L9 13l4 4 3.786-3.786a2 2 0 012.83 1.417z"/>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-deep-green mb-2">
                Candidature envoyée avec succès !
            </h1>
            <p class="text-slate-600 mb-6">
                Votre candidature au poste de <strong class="text-deep-green">{{ $application->job->title }}</strong>
                a été reçue par <strong class="text-deep-green">{{ $application->job->company->name }}</strong>.
            </p>

            <div class="bg-cream border border-slate-200 rounded-lg p-4 mb-6 text-left">
                <h3 class="font-semibold text-deep-green mb-2">Détails de la candidature</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <span class="text-slate-500">Numéro :</span>
                        <span class="font-medium text-deep-green">#{{ $application->id }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Statut :</span>
                        <span class="font-medium text-gold">{{ ucfirst($application->status) }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Date :</span>
                        <span class="font-medium">{{ $application->applied_at->format('d/m/Y à H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500">Entreprise :</span>
                        <span class="font-medium">{{ $application->job->company->name }}</span>
                    </div>
                </div>
            </div>

            <p class="text-sm text-slate-500 mb-8">
                Vous recevrez une notification par e-mail lorsque l'entreprise étudiera votre candidature.
                Vous pouvez suivre l'avancement depuis votre tableau de bord.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('candidate.dashboard') }}"
                    class="bg-deep-green hover:bg-deep-green-800 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
                    Voir mon tableau de bord
                </a>
                <a href="{{ route('jobs.index') }}"
                    class="border border-deep-green text-deep-green hover:bg-deep-green/5 font-semibold px-6 py-2.5 rounded-md transition-colors">
                    Découvrir d'autres offres
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
