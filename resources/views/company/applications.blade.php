@extends('layouts.app')

@section('title', 'Candidatures reçues — Jëf & Yoon')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-deep-green mb-2">Candidatures reçues</h1>
                <p class="text-slate-600">{{ $company->name }}</p>
            </div>
            <a href="{{ route('company.dashboard') }}"
                class="text-sm text-gold hover:text-deep-green transition-colors">
                ← Retour au tableau de bord
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-6xl">
    @include('components.flash')

    @if($applications->isEmpty())
        <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-slate-200">
            <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v4"/>
            </svg>
            <p class="text-slate-600 mb-2">Aucune candidature pour le moment.</p>
            <p class="text-sm text-slate-500">Les candidatures apparaîtront ici lorsqu'un candidat postulera à vos offres.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-slate-200">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left py-3 px-4 font-medium text-deep-green">Candidat</th>
                        <th class="text-left py-3 px-4 font-medium text-deep-green">Offre</th>
                        <th class="text-left py-3 px-4 font-medium text-deep-green">Date</th>
                        <th class="text-left py-3 px-4 font-medium text-deep-green">Statut</th>
                        <th class="text-left py-3 px-4 font-medium text-deep-green">CV</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                        @php
                            $statusColors = [
                                'pending' => 'bg-gold/10 text-gold',
                                'reviewed' => 'bg-deep-green/10 text-deep-green',
                                'accepted' => 'bg-coral/10 text-coral',
                                'rejected' => 'bg-slate-400/10 text-slate-500',
                            ];
                            $color = $statusColors[$app->status] ?? 'bg-slate-100 text-slate-600';
                            $candidateUser = \App\Models\User::find($app->user_id);
                        @endphp
                        <tr class="border-b border-slate-200 last:border-0">
                            <td class="py-3 px-4">
                                <div class="font-medium text-deep-green">{{ $candidateUser ? $candidateUser->name : 'Candidat #' . $app->user_id }}</div>
                                <div class="text-xs text-slate-500">{{ $candidateUser ? $candidateUser->email : '' }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('jobs.show', $app->job->slug) }}" class="text-deep-green hover:text-gold font-medium">{{ $app->job->title }}</a>
                            </td>
                            <td class="py-3 px-4 text-slate-500">{{ $app->applied_at->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-0.5 text-xs rounded {{ $color }}">
                                    {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @if($app->cv_path)
                                    <a href="#" class="text-deep-green hover:text-gold text-xs">Voir le CV</a>
                                @else
                                    <span class="text-xs text-slate-400">Aucun</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection
