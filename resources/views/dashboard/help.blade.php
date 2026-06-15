@php
    // Page Help - Dashboard
@endphp

@extends('layouts.app')

@section('header-title', 'Aide')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="font-h1 text-h1 text-primary dark:text-primary-fixed-dim font-bold">Centre d’aide</h1>
                <p class="mt-2 text-body">Retrouvez ici tout ce dont vous avez besoin pour utiliser NEARSEO efficacement.</p>
            </div>
            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-full border border-outline-variant dark:border-outline bg-surface-container-low hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined mr-2">arrow_back</span>
                    Retour au dashboard
                </a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-5 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">article</span>
                    <h2 class="font-h2 text-h2 text-primary dark:text-primary-fixed-dim text-sm font-bold">Articles</h2>
                </div>
                <p class="mt-2 text-body-sm text-on-surface-variant">Créer, publier et améliorer vos contenus.</p>
            </div>

            <div class="p-5 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">smart_toy</span>
                    <h2 class="font-h2 text-h2 text-primary dark:text-primary-fixed-dim text-sm font-bold">IA</h2>
                </div>
                <p class="mt-2 text-body-sm text-on-surface-variant">Générer, réécrire et optimiser grâce à l’assistance IA.</p>
            </div>

            <div class="p-5 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">location_on</span>
                    <h2 class="font-h2 text-h2 text-primary dark:text-primary-fixed-dim text-sm font-bold">Géolocalisation</h2>
                </div>
                <p class="mt-2 text-body-sm text-on-surface-variant">Rendre vos articles pertinents pour votre zone.</p>
            </div>
        </div>

        <div class="mt-6 p-6 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
            <h2 class="font-h3 text-h3 text-primary dark:text-primary-fixed-dim font-bold">Comment ça marche ?</h2>
            <ol class="mt-4 space-y-3 text-body">
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-primary">1_circle</span>
                    <span>
                        <span class="font-semibold">Créez votre article</span> : allez dans <b>Articles</b> puis <b>Nouveau</b>.
                    </span>
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-primary">2_circle</span>
                    <span>
                        <span class="font-semibold">Améliorez votre contenu</span> : utilisez <b>l’IA</b> pour générer, réécrire ou optimiser.
                    </span>
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-primary">3_circle</span>
                    <span>
                        <span class="font-semibold">Personnalisez pour la zone</span> : utilisez <b>Géolocalisation</b> pour cibler vos lecteurs.
                    </span>
                </li>
                <li class="flex gap-3">
                    <span class="material-symbols-outlined text-primary">4_circle</span>
                    <span>
                        <span class="font-semibold">Publiez et suivez</span> : surveillez vos vues et vos performances dans le dashboard.
                    </span>
                </li>
            </ol>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-6 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
                <h2 class="font-h3 text-h3 text-primary dark:text-primary-fixed-dim font-bold">FAQ express</h2>

                <div class="mt-4 space-y-4">
                    <div>
                        <p class="font-semibold text-body">Je ne vois pas où publier mon article ?</p>
                        <p class="mt-1 text-body-sm text-on-surface-variant">
                            Ouvrez la section <b>Articles</b> puis vérifiez le statut (brouillon / publié). Les actions de publication se trouvent sur la page de l’article.
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold text-body">L’IA peut-elle réécrire mon texte existant ?</p>
                        <p class="mt-1 text-body-sm text-on-surface-variant">
                            Oui. Allez dans <b>Stratégie de contenu (IA)</b> et choisissez <b>Réécrire</b>, puis copiez-collez votre contenu.
                        </p>
                    </div>

                    <div>
                        <p class="font-semibold text-body">Comment cibler une ville/zone ?</p>
                        <p class="mt-1 text-body-sm text-on-surface-variant">
                            Utilisez <b>Géolocalisation</b> pour rechercher une adresse ou une zone, puis appliquez-la à vos articles.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
                <h2 class="font-h3 text-h3 text-primary dark:text-primary-fixed-dim font-bold">Bonnes pratiques SEO local</h2>
                <ul class="mt-4 space-y-3 text-body">
                    <li class="flex gap-3">
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <span>Écrivez des titres clairs et orientés intention (ex : “Meilleur plombier à …”).</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <span>Ajoutez la zone dans le contenu de manière naturelle (sans sur-optimisation).</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <span>Utilisez des sections (H2/H3) pour améliorer la lisibilité et la compréhension.</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                        <span>Relisez votre article : qualité = meilleures performances.</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-6 p-6 rounded-2xl border border-outline-variant dark:border-outline bg-surface-container-lowest">
            <h2 class="font-h3 text-h3 text-primary dark:text-primary-fixed-dim font-bold">Besoin d’aide supplémentaire ?</h2>
            <p class="mt-2 text-body-sm text-on-surface-variant">
                Cette page peut être étendue avec des articles d’aide détaillés. Pour l’instant, vous pouvez utiliser les sections ci-dessus.
                Si vous voulez, je peux aussi créer des pages par thème (Compte, Articles, IA, Géolocalisation).
            </p>

            <div class="mt-4 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-primary text-on-primary font-semibold hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined">description</span>
                    Démarrer avec les Articles
                </a>
                <a href="{{ route('ai.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full border border-outline-variant dark:border-outline bg-surface-container-low hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined">smart_toy</span>
                    Essayer l’IA
                </a>
            </div>
        </div>
    </div>
@endsection

