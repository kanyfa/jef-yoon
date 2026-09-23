<footer class="bg-deep-green text-cream py-12 mt-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center space-x-2 text-xl font-bold mb-4">
                    <span class="text-gold">🧡</span>
                    <span>Jëf &amp; Yoon</span>
                </div>
                <p class="text-sm opacity-80">
                    Votre plateforme d'emploi dédiée au Sénégal. Trouvez le job qu'il vous convient et vérifiez l'accessibilité de votre trajet.
                </p>
                <div class="mt-4 p-3 bg-slate-800/20 rounded-md">
                    <p class="text-xs opacity-90">
                        <strong class="opacity-100">Note :</strong> Les distances, temps et coûts de transport affichés sont des <u>estimations indicatives</u> et ne reflètent pas des données en temps réel.
                    </p>
                </div>
            </div>

            <div>
                <h4 class="font-semibold mb-3 text-gold">À propos</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="opacity-70 hover:opacity-100 transition-opacity">Accueil</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="opacity-70 hover:opacity-100 transition-opacity">Offres d'emploi</a></li>
                    <li><span class="opacity-70">Accessibilité</span></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-3 text-gold">Espace candidat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('login') }}" class="opacity-70 hover:opacity-100 transition-opacity">Connexion / Inscription</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="opacity-70 hover:opacity-100 transition-opacity">Rechercher un emploi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-3 text-gold">Espace entreprise</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('register', ['role' => 'company']) }}" class="opacity-70 hover:opacity-100 transition-opacity">Créer un compte</a></li>
                    <li><span class="opacity-70">Publier une offre</span></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-700 mt-8 pt-6 text-center text-xs opacity-60">
            <p>&copy; 2025 Jëf &amp; Yoon. Tous droits réservés. | Dakar, Sénégal</p>
        </div>
    </div>
</footer>
