<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jëf & Yoon — Emploi au Sénégal')</title>
    <meta name="description" content="@yield('description', 'Jëf & Yoon : trouvez l\'emploi qu\'il vous convient au Sénégal. Offres d\'emploi, accès, candidature simplifiée.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    @include('components.nav')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('components.footer')
</body>
</html>
