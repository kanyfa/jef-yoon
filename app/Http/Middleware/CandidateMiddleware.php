<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CandidateMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'candidate') {
            return redirect()->route('company.dashboard')
                ->with('error', 'Cette section est réservée aux candidats.');
        }

        return $next($request);
    }
}
