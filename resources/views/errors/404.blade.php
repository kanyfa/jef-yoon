@extends('layouts.app')

@section('title', 'Page non trouvée — Jëf & Yoon')

@section('content')
<div class="min-h-screen bg-cream flex items-center justify-center py-16">
    <div class="text-center">
        <div class="text-8xl font-bold text-deep-green mb-4">404</div>
        <h1 class="text-2xl font-bold text-deep-green mb-2">Page non trouvée</h1>
        <p class="text-slate-600 mb-8">
            La page que vous recherchez n'existe pas ou a été déplacée.
        </p>
        <a href="{{ route('home') }}"
            class="inline-flex items-center bg-deep-green hover:bg-deep-green-800 text-white font-semibold px-6 py-3 rounded-md transition-colors">
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection
