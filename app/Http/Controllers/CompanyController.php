<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function dashboard(Request $request)
    {
        $company = $request->user()->company;

        $jobs = $company->jobs()->latest()->limit(10)->get();
        $applicationsCount = Application::whereIn('job_id', $company->jobs()->pluck('id'))->count();

        $recentApplications = Application::whereIn('job_id', $company->jobs()->pluck('id'))
            ->with('job')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('company.dashboard', [
            'company' => $company,
            'jobs' => $jobs,
            'stats' => [
                'jobs' => $company->jobs()->count(),
                'applications' => $applicationsCount,
            ],
            'recentApplications' => $recentApplications,
        ]);
    }

    public function createJob(Request $request)
    {
        $company = $request->user()->company;

        return view('company.jobs.create', [
            'company' => $company,
        ]);
    }

    public function storeJob(Request $request)
    {
        $company = $request->user()->company;

        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'location' => ['required', 'string', 'max:100'],
            'contract_type' => ['required', 'string', 'max:50'],
            'experience_level' => ['required', 'string', 'max:50'],
            'salary_min' => ['nullable', 'integer', 'min:0'],
            'salary_max' => ['nullable', 'integer', 'gte:salary_min'],
            'skills_required' => ['required', 'array', 'min:1'],
            'skills_required.*' => ['string', 'max:50'],
            'description' => ['required', 'string', 'min:100'],
            'skills_input' => ['nullable', 'string'],
        ], [
            'title.required' => 'Le titre de l\'offre est requis.',
            'location.required' => 'La localisation est requise.',
            'contract_type.required' => 'Le type de contrat est requis.',
            'experience_level.required' => 'Le niveau d\'expérience est requis.',
            'skills_required.required' => 'Spécifiez au moins une compétence.',
            'description.required' => 'La description est requise.',
            'description.min' => 'La description doit contenir au moins 100 caractères.',
        ]);

        $skills = $data['skills_required'];
        if ($data['skills_input']) {
            $extra = array_filter(array_map('trim', explode(',', $data['skills_input'])));
            $skills = array_values(array_unique(array_merge($skills, $extra)));
        }

        $job = $company->jobs()->create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title'] . '-' . Str::random(6)),
            'location' => $data['location'],
            'contract_type' => $data['contract_type'],
            'experience_level' => $data['experience_level'],
            'salary_min' => $data['salary_min'],
            'salary_max' => $data['salary_max'],
            'skills_required' => $skills,
            'description' => $data['description'],
            'is_active' => true,
            'posted_at' => now(),
        ]);

        return redirect()->route('company.dashboard')
            ->with('success', "L'offre '{$job->title}' a été publiée avec succès.");
    }

    public function applications(Request $request)
    {
        $company = $request->user()->company;

        $applications = Application::whereIn('job_id', $company->jobs()->pluck('id'))
            ->with('job')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('company.applications', [
            'company' => $company,
            'applications' => $applications,
        ]);
    }
}
