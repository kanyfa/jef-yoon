<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $featuredJobs = Job::active()
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $stats = [
            'jobs' => Job::active()->count(),
            'companies' => \App\Models\Company::count(),
            'locations' => collect([
                'Dakar', 'Pikine', 'Guediawaye', 'Rufisque', 'Thiadiaye',
                'Diourbel', 'Louga', 'Yoff', 'Ouakam', 'Mermoz',
            ])->unique()->count(),
        ];

        return view('home', [
            'featuredJobs' => $featuredJobs,
            'stats' => $stats,
        ]);
    }
}
