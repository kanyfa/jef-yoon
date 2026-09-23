@extends('layouts.app')

@section('title', 'Mon profil — Jëf & Yoon')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-deep-green mb-2">Mon profil candidat</h1>
        <p class="text-slate-600">Complétez votre profil en 4 étapes pour optimiser vos candidatures.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-slate-700">Progression du profil</span>
            <span class="text-sm font-medium text-deep-green">Étape {{ $step }} sur 4</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2.5">
            <div class="bg-deep-green h-2.5 rounded-full transition-all" style="width: {{ $step * 25 }}%"></div>
        </div>
    </div>

    @include('components.flash')

    <div class="flex space-x-2 mb-6 overflow-x-auto pb-1">
        @foreach([1 => 'Informations', 2 => 'Compétences', 3 => 'Bio & expérience', 4 => 'CV'] as $num => $label)
            <a href="{{ route('candidate.profile', ['step' => $num]) }}"
                class="px-4 py-2 rounded-md text-sm font-medium transition-all flex-shrink-0
                    {{ $step == $num ? 'bg-deep-green text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                {{ $num }}. {{ $label }}
            </a>
        @endforeach
    </div>

    @if(!$candidate)
        <div class="bg-cream/30 border border-slate-200 rounded-lg p-4 mb-6">
            <p class="text-sm text-slate-600">
                Ce profil est lié à votre compte. Commencez par la première étape pour créer votre fiche candidat.
            </p>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        @if($step == 1)
            @include('candidate.profile.step1', ['candidate' => $candidate])
        @elseif($step == 2)
            @include('candidate.profile.step2', ['candidate' => $candidate])
        @elseif($step == 3)
            @include('candidate.profile.step3', ['candidate' => $candidate])
        @elseif($step == 4)
            @include('candidate.profile.step4', ['candidate' => $candidate])
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    function addSkill(inputId, containerId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const value = input.value.trim();
        if (!value) return;

        const existing = container.querySelectorAll('input[name="skills[]"]');
        for (let i = 0; i < existing.length; i++) {
            if (existing[i].value === value) return;
        }

        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'skills[]';
        hidden.value = value;
        container.appendChild(hidden);

        const tag = document.createElement('span');
        tag.className = 'inline-flex items-center gap-1.5 text-xs font-medium bg-deep-green/10 text-deep-green px-2.5 py-1 rounded-full';
        tag.innerHTML = value + ' <button type="button" onclick="removeSkill(this, \'' + value + '\')" class="hover:text-coral">&times;</button>';
        container.appendChild(tag);

        input.value = '';
    }

    function removeSkill(button, value) {
        const container = button.parentNode.parentNode;
        const hiddens = container.querySelectorAll('input[name="skills[]"]');
        hiddens.forEach(function(h) {
            if (h.value === value) h.remove();
        });
        button.parentNode.remove();
    }

    function removeExistingSkill(button, value) {
        const container = button.parentNode.parentNode;
        const hiddens = container.querySelectorAll('input[name="skills[]"]');
        hiddens.forEach(function(h) {
            if (h.value === value) h.remove();
        });
        button.parentNode.remove();
    }
</script>
@endsection
