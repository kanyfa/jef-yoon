<form method="POST" action="{{ route('candidate.profile.update', ['step' => 4]) }}" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="first_name" value="{{ $candidate?->first_name ?? '' }}">
    <input type="hidden" name="last_name" value="{{ $candidate?->last_name ?? '' }}">
    <input type="hidden" name="phone" value="{{ $candidate?->phone ?? auth()->user()->phone ?? '' }}">
    <input type="hidden" name="location" value="{{ $candidate?->location ?? auth()->user()->location ?? '' }}">
    <input type="hidden" name="level" value="{{ $candidate?->level ?? '' }}">
    <input type="hidden" name="contract_type_preference" value="{{ $candidate?->contract_type_preference ?? '' }}">

    @if($candidate && $candidate->skills)
        @foreach($candidate->skills as $skill)
            <input type="hidden" name="skills[]" value="{{ $skill }}">
        @endforeach
    @endif

    @if($candidate)
        <input type="hidden" name="bio" value="{{ $candidate?->bio ?? '' }}">
        <input type="hidden" name="experience" value="{{ $candidate?->experience ?? '' }}">
    @endif

    <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-deep-green transition-colors">
        <svg class="w-12 h-12 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V8m0 0l-3 3m3-3l3 3M7 16l3-3m0 0v8"/>
        </svg>
        <label class="block text-sm font-medium text-slate-700 mb-2 cursor-pointer">
            <span>Télécharger votre CV</span>
            <input type="file" name="cv" accept=".pdf,.doc,.docx"
                class="hidden">
        </label>
        <p class="text-xs text-slate-500">PDF, DOC ou DOCX — max 5 Mo</p>
        @if($candidate && $candidate->cv_path)
            <div class="mt-3 text-sm text-deep-green">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M9 8h6"/>
                </svg>
                CV actuel : {{ basename($candidate->cv_path) }}
            </div>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Compétences supplémentaires (facultatif)</label>
        <input type="text" placeholder="Séparez par des virgules : Ex: Gestion de projet, Scrum..."
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50">
        <p class="text-xs text-slate-500 mt-1">Ces compétences seront ajoutées à votre profil.</p>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('candidate.profile', ['step' => 3]) }}"
            class="text-sm text-slate-600 hover:text-deep-green transition-colors">← Retour</a>
        <div class="flex gap-3">
            <a href="{{ route('candidate.dashboard') }}"
                class="text-sm text-slate-600 hover:text-deep-green transition-colors">Tableau de bord</a>
            <button type="submit"
                class="bg-coral hover:bg-coral/90 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
                Enregistrer
            </button>
        </div>
    </div>
</form>
