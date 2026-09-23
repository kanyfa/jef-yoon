<form method="POST" action="{{ route('candidate.profile.update', ['step' => 1]) }}" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Prénom *</label>
            <input type="text" name="first_name" value="{{ $candidate?->first_name ?? '' }}" required
                class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-2">Nom *</label>
            <input type="text" name="last_name" value="{{ $candidate?->last_name ?? '' }}" required
                class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Téléphone *</label>
        <input type="tel" name="phone" value="{{ $candidate?->phone ?? '' }}" required
            class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
        <p class="text-xs text-slate-500 mt-1">Format : 77 234 56 78</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Localisation *</label>
        <input type="text" name="location" list="locations-step1" value="{{ $candidate?->location ?? '' }}" required
            class="w-full px-4 py-2.5 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-deep-green/50 focus:border-deep-green">
        <datalist id="locations-step1">
            @foreach(['Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Thiadiaye', 'Yoff', 'Ouakam', 'Mermoz', 'Diourbel', 'Louga', 'Sacré-Cœur', 'Hann', 'Bopp', 'Parcelles', 'Grand Yoff'] as $loc)
                <option value="{{ $loc }}">{{ $loc }}</option>
            @endforeach
        </datalist>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('candidate.dashboard') }}"
            class="text-sm text-slate-600 hover:text-deep-green transition-colors">← Tableau de bord</a>
        <button type="submit"
            class="bg-deep-green hover:bg-deep-green-800 text-white font-semibold px-6 py-2.5 rounded-md transition-colors">
            Suivant →
        </button>
    </div>
</form>
