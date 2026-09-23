<form method="POST" action="{{ route('candidate.profile.update', ['step' => 3]) }}" class="space-y-6">
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

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Biographie / Bio *</label>
        <textarea name="bio" rows="4" required minlength="50" maxlength="1000"
                  placeholder="Parlez-nous de vous, de vos motivations et de ce que vous recherchez..."
                  class="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green resize-y">{{ $candidate?->bio ?? '' }}</textarea>
        @error('bio') <p class="text-xs text-coral mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Expérience professionnelle *</label>
        <textarea name="experience" rows="5" required minlength="50" maxlength="2000"
                  placeholder="Décrivez votre parcours, postes, responsabilités et réalisations clés..."
                  class="w-full px-4 py-3 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green resize-y">{{ $candidate?->experience ?? '' }}</textarea>
        @error('experience') <p class="text-xs text-coral mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('candidate.profile', ['step' => 2]) }}"
            class="text-sm text-slate-600 hover:text-deep-green transition-colors">← Retour</a>
        <button type="submit"
            class="bg-deep-green hover:bg-deep-green-800 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
            Suivant →
        </button>
    </div>
</form>
