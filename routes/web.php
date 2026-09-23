<?php

use App\Http\Controllers\AccessibilityController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, '__invoke'])->name('home');

Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/connexion', [AuthController::class, 'login'])->middleware('guest');
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/inscription', [AuthController::class, 'register'])->middleware('guest');
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/emplois', [JobController::class, 'index'])->name('jobs.index');
Route::get('/emplois/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/emplois/{job}/accessibilite', [AccessibilityController::class, '__invoke'])
    ->name('jobs.accessibility');

Route::middleware(['auth', 'candidate'])->group(function () {
    Route::get('/candidat/profil', [CandidateController::class, 'profile'])->name('candidate.profile');
    Route::put('/candidat/profil/{step}', [CandidateController::class, 'profileUpdate'])->name('candidate.profile.update');
    Route::get('/candidat/tableau-de-bord', [CandidateController::class, 'dashboard'])->name('candidate.dashboard');

    Route::get('/emplois/{job}/postuler', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/emplois/{job}/postuler', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/candidature/{application}/confirmation', [ApplicationController::class, 'confirmation'])
        ->name('applications.confirmation');
});

Route::middleware(['auth', 'company'])->group(function () {
    Route::get('/entreprise/tableau-de-bord', [CompanyController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/entreprise/offres/creer', [CompanyController::class, 'createJob'])->name('company.jobs.create');
    Route::post('/entreprise/offres', [CompanyController::class, 'storeJob'])->name('company.jobs.store');
    Route::get('/entreprise/candidatures', [CompanyController::class, 'applications'])->name('company.applications');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
