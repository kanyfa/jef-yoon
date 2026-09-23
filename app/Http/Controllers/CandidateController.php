<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CandidateController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        $candidate = $user->candidate;

        $applications = $user->applications()
            ->with('job.company')
            ->latest()
            ->limit(10)
            ->get();

        $stats = [
            'total' => $user->applications()->count(),
            'pending' => $user->applications()->where('status', 'pending')->count(),
            'reviewed' => $user->applications()->where('status', 'reviewed')->count(),
            'accepted' => $user->applications()->where('status', 'accepted')->count(),
        ];

        return view('candidate.dashboard', [
            'candidate' => $candidate,
            'applications' => $applications,
            'stats' => $stats,
        ]);
    }

    public function profile(Request $request)
    {
        $candidate = $request->user()->candidate;
        $step = $request->query('step', $candidate ? 1 : 1);
        $step = max(1, min(4, (int) $step));

        return view('candidate.profile', [
            'candidate' => $candidate,
            'step' => $step,
        ]);
    }

    public function profileUpdate(Request $request, $step)
    {
        $step = max(1, min(4, (int) $step));

        $rules = [
            1 => [
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'phone' => ['required', 'string', 'max:20'],
                'location' => ['required', 'string', 'max:100'],
            ],
            2 => [
                'level' => ['required', 'string', 'max:50'],
                'contract_type_preference' => ['required', 'string', 'max:50'],
                'skills' => ['required', 'array', 'min:1'],
                'skills.*' => ['string', 'max:50'],
            ],
            3 => [
                'bio' => ['required', 'string', 'min:50', 'max:1000'],
                'experience' => ['required', 'string', 'min:50', 'max:2000'],
            ],
            4 => [
                'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            ],
        ][$step] ?? [];

        $validated = $request->validate($rules, [
            'first_name.required' => 'Le prénom est requis.',
            'last_name.required' => 'Le nom est requis.',
            'phone.required' => 'Le téléphone est requis.',
            'location.required' => 'La localisation est requise.',
            'level.required' => 'Le niveau est requis.',
            'contract_type_preference.required' => 'Le type de contrat est requis.',
            'skills.required' => 'Sélectionnez au moins une compétence.',
            'bio.required' => 'La bio est requise.',
            'bio.min' => 'La bio doit contenir au moins 50 caractères.',
            'experience.required' => "L'expérience est requise.",
            'cv.mimes' => 'Le CV doit être au format PDF, DOC ou DOCX.',
            'cv.max' => 'Le CV ne peut pas dépasser 5 Mo.',
        ]);

        $user = $request->user();
        $candidate = $user->candidate ?? new Candidate(['user_id' => $user->id]);

        if ($step === 1) {
            $user->update([
                'phone' => $validated['phone'],
                'location' => $validated['location'],
            ]);
        }

        $candidate->first_name = $validated['first_name'] ?? $candidate->first_name;
        $candidate->last_name = $validated['last_name'] ?? $candidate->last_name;
        $candidate->phone = $validated['phone'] ?? $candidate->phone;
        $candidate->location = $validated['location'] ?? $candidate->location;
        $candidate->level = $validated['level'] ?? $candidate->level;
        $candidate->contract_type_preference = $validated['contract_type_preference'] ?? $candidate->contract_type_preference;
        $candidate->skills = $validated['skills'] ?? $candidate->skills;
        $candidate->bio = $validated['bio'] ?? $candidate->bio;
        $candidate->experience = $validated['experience'] ?? $candidate->experience;

        if ($step === 4 && $request->hasFile('cv')) {
            $path = $request->file('cv')->store('cvs', 'public');
            $candidate->cv_path = $path;
        }

        $candidate->user_id = $user->id;
        $candidate->save();

        $nextStep = $step + 1;
        $message = $step < 4
            ? "Étape {$step} enregistrée avec succès. Passez à l'étape suivante."
            : "Profil terminé avec succès ! Vous pouvez maintenant postuler à des offres.";

        return redirect()->route('candidate.profile', ['step' => $nextStep > 4 ? 4 : $nextStep])
            ->with('success', $message);
    }
}
