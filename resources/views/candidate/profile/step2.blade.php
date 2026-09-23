<form method="POST" action="{{ route('candidate.profile.update', ['step' => 2]) }}" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Compétences *</label>
        <p class="text-xs text-slate-500 mb-2">Sélectionnez vos compétences clés.</p>
        <input type="text" id="skill-input" placeholder="Ex: PHP, Laravel, JavaScript..."
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green"
            onkeyup="event.key === 'Enter' && (addSkill('skill-input', 'skills-container'), event.preventDefault())">

        <div id="skills-container" class="mt-3 flex flex-wrap gap-2">
            @if($candidate && $candidate->skills)
                @foreach($candidate->skills as $skill)
                    <input type="hidden" name="skills[]" value="{{ $skill }}">
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium bg-deep-green/10 text-deep-green px-2.5 py-1 rounded-full">
                        {{ $skill }}
                        <button type="button" onclick="removeExistingSkill(this, '{{ $skill }}')" class="hover:text-coral">&times;</button>
                    </span>
                @endforeach
            @endif
        </div>
        @error('skills') <p class="text-xs text-coral mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Niveau d'études</label>
        <select name="level"
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
            <option value="">Choisir...</option>
            @foreach(['Lycée', 'BTS/DUT', 'Licence', 'Master', 'Doctorat', 'Autre'] as $level)
                <option value="{{ $level }}" {{ ($candidate && $candidate->level == $level) ? 'selected' : '' }}>{{ $level }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Type de contrat recherché *</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach(['CDI', 'CDD', 'Intérim', 'Stage', 'Freelance', 'Temps partiel'] as $ct)
                <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-md hover:bg-cream cursor-pointer">
                    <input type="radio" name="contract_type_preference" value="{{ $ct }}"
                        {{ ($candidate && $candidate->contract_type_preference == $ct) ? 'checked' : '' }}
                        class="text-deep-green focus:ring-deep-green">
                    <span class="text-sm">{{ $ct }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('candidate.profile', ['step' => 1]) }}"
            class="text-sm text-slate-600 hover:text-deep-green transition-colors">← Retour</a>
        <button type="submit"
            class="bg-deep-green hover:bg-deep-green-800 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
            Suivant →
        </button>
    </div>
</form>
