@extends('layouts.app')

@section('title', 'Publier une offre — Jëf & Yoon')

@section('content')
<div class="bg-white border-b border-slate-200">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-deep-green mb-2">Publier une nouvelle offre</h1>
        <p class="text-slate-600">Chez {{ $company->name }}</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <form method="POST" action="{{ route('company.jobs.store') }}" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">Titre de l'offre *</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Localisation *</label>
                <input type="text" name="location" list="comp-locations" value="{{ old('location') }}" required
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                <datalist id="comp-locations">
                    @foreach(['Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Thiadiaye', 'Yoff', 'Ouakam', 'Mermoz', 'Diourbel', 'Louga', 'Sacré-Cœur', 'Hann', 'Bopp', 'Parcelles', 'Grand Yoff'] as $loc)
                        <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </datalist>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Type de contrat *</label>
                <select name="contract_type" required
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                    <option value="">Choisir...</option>
                    @foreach(['CDI', 'CDD', 'Intérim', 'Stage', 'Freelance', 'Temps partiel'] as $ct)
                        <option value="{{ $ct }}" {{ old('contract_type') == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Niveau d'expérience *</label>
                <select name="experience_level" required
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
                    <option value="">Choisir...</option>
                    @foreach(['Débutant', '1-2 ans', '3-5 ans', '6-10 ans', 'Senior', 'Expert'] as $level)
                        <option value="{{ $level }}" {{ old('experience_level') == $level ? 'selected' : '' }}>{{ $level }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Salaire minimum (FCFA)</label>
                <input type="number" name="salary_min" value="{{ old('salary_min', 200000) }}"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Salaire maximum (FCFA)</label>
                <input type="number" name="salary_max" value="{{ old('salary_max', 500000) }}"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">Compétences requises *</label>
                <div class="flex gap-2 mb-2">
                    <input type="text" id="skill-input-company" placeholder="Ex: PHP, Laravel..."
                        class="flex-1 px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50"
                        onkeyup="event.key==='Enter' && (addCompanySkill('skill-input-company','skills-company'), event.preventDefault())">
                    <button type="button" onclick="addCompanySkill('skill-input-company','skills-company')"
                        class="px-3 py-1 bg-deep-green text-white rounded-md hover:bg-deep-green-800 transition-colors text-sm">
                        Ajouter
                    </button>
                </div>
                <div id="skills-company" class="flex flex-wrap gap-2">
                    @if(old('skills_required'))
                        @foreach(old('skills_required') as $skill)
                            <span class="inline-flex items-center text-xs font-medium bg-deep-green/10 text-deep-green px-2.5 py-1 rounded-full">
                                <span>{{ $skill }}</span>
                                <input type="hidden" name="skills_required[]" value="{{ $skill }}">
                                <button type="button" onclick="this.parentNode.parentNode.remove()" class="ml-1 hover:text-coral">&times;</button>
                            </span>
                        @endforeach
                    @endif
                </div>
                @error('skills_required')
                    <p class="text-xs text-coral mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Compétences supplémentaires (facultatif)
                </label>
                <input type="text" name="skills_input" placeholder="Séparez par des virgules"
                    class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700 mb-2">Description du poste *</label>
                <textarea name="description" rows="8" required minlength="100" maxlength="3000"
                    placeholder="Décrivez le poste, les responsabilités, les missions et les conditions de travail..."
                    class="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green resize-y">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-coral mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-between items-center pt-4 border-t border-slate-200">
            <a href="{{ route('company.dashboard') }}"
                class="text-sm text-slate-600 hover:text-deep-green transition-colors">
                ← Retour au tableau de bord
            </a>
            <button type="submit"
                class="bg-coral hover:bg-coral/90 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
                Publier l'offre
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function addCompanySkill(inputId, containerId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const value = input.value.trim();
        if (!value) return;

        const existing = Array.from(container.querySelectorAll('input[name="skills_required[]"]'))
            .find(h => h.value === value);
        if (existing) { input.value = ''; return; }

        const tag = document.createElement('span');
        tag.className = 'inline-flex items-center text-xs font-medium bg-deep-green/10 text-deep-green px-2.5 py-1 rounded-full';

        const label = document.createElement('span');
        label.textContent = value;
        tag.appendChild(label);

        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'skills_required[]';
        hidden.value = value;
        tag.appendChild(hidden);

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'ml-1 hover:text-coral';
        btn.innerHTML = '&times;';
        btn.onclick = function() { tag.remove(); };
        tag.appendChild(btn);

        container.appendChild(tag);
        input.value = '';
    }
</script>
@endsection
