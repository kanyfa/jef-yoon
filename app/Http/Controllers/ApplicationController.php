<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function create(Job $job)
    {
        if (! $job->is_active) {
            abort(404);
        }

        $existing = Application::where('user_id', Auth::id())
            ->where('job_id', $job->id)
            ->first();

        if ($existing) {
            return redirect()->route('applications.confirmation', $existing);
        }

        return view('applications.create', [
            'job' => $job,
            'candidate' => Auth::user()->candidate,
        ]);
    }

    public function store(Request $request, Job $job)
    {
        if (! $job->is_active) {
            abort(404);
        }

        $existing = Application::where('user_id', Auth::id())
            ->where('job_id', $job->id)
            ->first();

        if ($existing) {
            return redirect()->route('applications.confirmation', $existing);
        }

        $data = $request->validate([
            'motivation' => ['required', 'string', 'min:100', 'max:2000'],
        ], [
            'motivation.required' => 'La lettre de motivation est requise.',
            'motivation.min' => 'La lettre de motivation doit contenir au moins 100 caractères.',
            'motivation.max' => 'La lettre de motivation ne peut pas dépasser 2000 caractères.',
        ]);

        $application = Application::create([
            'user_id' => Auth::id(),
            'job_id' => $job->id,
            'cover_letter' => $data['motivation'],
            'cv_path' => Auth::user()->candidate?->cv_path,
            'status' => 'pending',
            'applied_at' => now(),
        ]);

        return redirect()->route('applications.confirmation', $application);
    }

    public function confirmation(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(404);
        }

        $application->load('job.company');

        return view('applications.confirmation', [
            'application' => $application,
        ]);
    }
}
