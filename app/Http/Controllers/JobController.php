<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only([
            'keyword', 'location', 'contract_type', 'experience_level', 'skill',
        ]);

        $sort = $request->query('sort', 'date_desc');

        $locations = [
            'Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Thiadiaye',
            'Diourbel', 'Louga', 'Yoff', 'Ouakam', 'Mermoz', 'Sacré-Cœur',
            'Hann', 'Bopp', 'Parcelles', 'Grand Yoff',
        ];

        $contractTypes = ['CDI', 'CDD', 'Intérim', 'Stage', 'Freelance', 'Temps partiel'];
        $experienceLevels = ['Débutant', '1-2 ans', '3-5 ans', '6-10 ans', 'Senior', 'Expert'];

        $jobs = Job::query()
            ->filter($filters)
            ->sorted($sort)
            ->with('company')
            ->paginate(12)
            ->appends($request->query());

        return view('jobs.index', [
            'jobs' => $jobs,
            'filters' => $filters,
            'sort' => $sort,
            'locations' => $locations,
            'contractTypes' => $contractTypes,
            'experienceLevels' => $experienceLevels,
        ]);
    }

    public function show(Job $job)
    {
        if (! $job->is_active) {
            abort(404);
        }

        $job->load('company');

        $relatedJobs = Job::active()
            ->where('id', '!=', $job->id)
            ->where('location', $job->location)
            ->limit(3)
            ->get();

        $transportModes = [
            ['mode' => 'Taxi', 'cost' => '2 500 FCFA', 'time' => '25 min'],
            ['mode' => 'Bus', 'cost' => '200 FCFA', 'time' => '45 min'],
            ['mode' => 'Moto-taxi', 'cost' => '1 500 FCFA', 'time' => '15 min'],
            ['mode' => 'Vélo', 'cost' => '0 FCFA', 'time' => '35 min'],
        ];

        $access = [
            'distance' => '5.2 km',
            'estimated_time' => '30 min',
            'estimated_cost' => '1 200 FCFA',
            'modes' => $transportModes,
        ];

        return view('jobs.show', [
            'job' => $job,
            'relatedJobs' => $relatedJobs,
            'access' => $access,
        ]);
    }
}
