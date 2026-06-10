<!DOCTYPE html>
<html class="scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NEARSEO | Le SEO local propulsé par l'IA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#d1e4fb",
                        "inverse-on-surface": "#e8f2ff",
                        "surface-container-highest": "#d1e4fb",
                        "primary-fixed": "#ffdbce",
                        "secondary": "#47664b",
                        "tertiary-container": "#b06000",
                        "primary": "#8c4a2f",
                        "on-error": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "on-error-container": "#93000a",
                        "on-surface": "#091d2e",
                        "secondary-fixed": "#c9ecc9",
                        "surface-dim": "#c9dcf3",
                        "tertiary-fixed": "#ffdcc2",
                        "error-container": "#ffdad6",
                        "on-secondary-fixed-variant": "#304d34",
                        "on-primary-container": "#fffbff",
                        "background": "#f7f9ff",
                        "primary-container": "#a96245",
                        "surface": "#f7f9ff",
                        "on-secondary-container": "#4d6c50",
                        "inverse-surface": "#203243",
                        "on-tertiary-fixed": "#2e1500",
                        "outline": "#86736c",
                        "inverse-primary": "#ffb599",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#d9eaff",
                        "on-tertiary": "#ffffff",
                        "on-background": "#091d2e",
                        "tertiary-fixed-dim": "#ffb77c",
                        "error": "#ba1a1a",
                        "surface-container": "#e3efff",
                        "secondary-container": "#c9ecc9",
                        "on-primary-fixed-variant": "#71361c",
                        "on-primary-fixed": "#370e00",
                        "surface-tint": "#8e4c31",
                        "secondary-fixed-dim": "#adcfae",
                        "outline-variant": "#d9c2ba",
                        "on-secondary-fixed": "#03210c",
                        "on-surface-variant": "#53433d",
                        "tertiary": "#8c4b00",
                        "surface-bright": "#f7f9ff",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#edf4ff",
                        "on-tertiary-container": "#fffbff",
                        "primary-fixed-dim": "#ffb599"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-gap-sm": "8px",
                        "stack-gap-md": "16px",
                        "section-margin": "32px",
                        "container-max-width": "1280px",
                        "gutter": "16px",
                        "card-padding": "24px"
                    },
                    "fontFamily": {
                        "label": ["Inter"],
                        "h3": ["Inter"],
                        "h1-mobile": ["Inter"],
                        "body": ["Inter"],
                        "body-sm": ["Inter"],
                        "h2": ["Inter"],
                        "h1": ["Inter"]
                    },
                    "fontSize": {
                        "label": ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "h3": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "h1-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "body": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "h2": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "h1": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body overflow-x-hidden">

<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/80 dark:bg-surface/80 backdrop-blur-md border-b border-outline-variant/30 dark:border-outline/20">
    <div class="max-w-container-max-width mx-auto px-gutter flex justify-between items-center h-20">
        <div class="flex items-center gap-stack-gap-sm">
             <img src="{{ asset('logo.svg') }}" 
         alt="NEARSEO Logo" 
         class="h-20 w-auto"
         onerror="this.src='{{ asset('images/logo.png') }}'">
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary transition-colors py-1" href="#features">Fonctionnalités</a>
            <a class="text-on-surface-variant dark:text-on-surface-variant/80 font-body text-body hover:text-primary dark:hover:text-primary-fixed-dim transition-colors" href="#pricing">Tarifs</a>
            <a class="text-on-surface-variant dark:text-on-surface-variant/80 font-body text-body hover:text-primary dark:hover:text-primary-fixed-dim transition-colors" href="#">Blog</a>
            <a href="{{ route('login') }}" class="text-on-surface-variant dark:text-on-surface-variant/80 font-body text-body hover:text-primary dark:hover:text-primary-fixed-dim transition-colors">Connexion</a>
        </nav>
        <a href="{{ route('register') }}" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-label transition-all active:scale-95">
            Essai gratuit
        </a>
    </div>
</header>

<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-24 md:py-32">
        <div class="max-w-container-max-width mx-auto px-gutter grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="flex flex-col gap-stack-gap-md items-start">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-secondary-container text-on-secondary-container text-body-sm font-label animate-fade-in">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">stars</span>
                    <span>Plus de 1000 commerçants nous font confiance</span>
                </div>
                <h1 class="font-h1 text-[48px] md:text-[64px] leading-[1.1] text-on-surface max-w-[600px]">
                    Le SEO local propulsé par <span class="text-primary">l'IA</span>
                </h1>
                <p class="font-body text-h2 text-on-surface-variant max-w-[500px]">
                    Générez des articles optimisés pour Google en 3 informations seulement. Dominez votre marché local sans effort.
                </p>
                <div class="flex flex-wrap gap-4 mt-4">
                    <a href="{{ route('register') }}" class="bg-primary text-on-primary px-8 py-4 rounded-lg font-h3 shadow-lg shadow-primary/20 hover:shadow-xl hover:-translate-y-1 transition-all active:scale-95">
                        Commencer gratuitement
                    </a>
                    <button class="border border-outline text-on-surface px-8 py-4 rounded-lg font-h3 hover:bg-surface-container transition-all">
                        Voir la démo
                    </button>
                </div>
            </div>
            <div class="relative">
                <!-- Dashboard Mockup -->
                <div class="glass-card rounded-xl shadow-2xl p-6 relative z-10 overflow-hidden">
                    <div class="flex items-center justify-between mb-6 border-b border-outline-variant/30 pb-4">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-error/20"></div>
                            <div class="w-3 h-3 rounded-full bg-tertiary-fixed-dim"></div>
                            <div class="w-3 h-3 rounded-full bg-secondary-fixed"></div>
                        </div>
                        <div class="text-body-sm text-on-surface-variant flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">lock</span>
                            app.nearseo.com
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-secondary/5 rounded-lg border-l-4 border-secondary">
                            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                            <div>
                                <p class="text-body-sm font-bold text-secondary">Optimisation IA active</p>
                                <p class="text-[12px] text-on-secondary-container">Score de pertinence locale : 98/100</p>
                            </div>
                        </div>
                        <div class="p-6 bg-surface-container-lowest rounded-lg border border-outline-variant/20 shadow-sm">
                            <h3 class="font-h3 text-primary mb-2">Les meilleurs boulangers de Bordeaux</h3>
                            <div class="h-2 w-3/4 bg-outline-variant/20 rounded mb-2"></div>
                            <div class="h-2 w-full bg-outline-variant/20 rounded mb-2"></div>
                            <div class="h-2 w-5/6 bg-outline-variant/20 rounded mb-4"></div>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="h-20 bg-surface-variant/50 rounded-lg"></div>
                                <div class="h-20 bg-surface-variant/50 rounded-lg"></div>
                                <div class="h-20 bg-surface-variant/50 rounded-lg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Decorative shapes -->
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-primary/10 rounded-full blur-3xl -z-10"></div>
                <div class="absolute -bottom-12 -left-12 w-48 h-48 bg-secondary/10 rounded-full blur-3xl -z-10"></div>
            </div>
        </div>
    </section>

    <!-- Fonctionnalités Section -->
    <section id="features" class="py-section-margin bg-surface-container-low">
        <div class="max-w-container-max-width mx-auto px-gutter">
            <div class="text-center max-w-[800px] mx-auto mb-16">
                <h2 class="font-h1 text-h2 md:text-h1 mb-4 text-on-surface">Une suite complète pour votre visibilité locale</h2>
                <p class="text-on-surface-variant font-body">Libérez le potentiel de votre commerce avec des outils conçus pour l'impact et la simplicité.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-stack-gap-md">
                <!-- Feature 1 -->
                <div class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant/30 hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 bg-primary-fixed rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-primary">neurology</span>
                    </div>
                    <h3 class="font-h3 text-on-surface mb-3">Génération IA</h3>
                    <p class="text-body-sm text-on-surface-variant">Notre moteur IA exclusif rédige des contenus captivants qui parlent à vos clients tout en séduisant les algorithmes.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant/30 hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 bg-secondary-fixed rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-secondary">analytics</span>
                    </div>
                    <h3 class="font-h3 text-on-surface mb-3">SEO en temps réel</h3>
                    <p class="text-body-sm text-on-surface-variant">Analyse instantanée des mots-clés locaux les plus performants pour garantir que chaque mot compte pour votre classement.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant/30 hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 bg-tertiary-fixed rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-tertiary">location_on</span>
                    </div>
                    <h3 class="font-h3 text-on-surface mb-3">Géolocalisation</h3>
                    <p class="text-body-sm text-on-surface-variant">Ciblez précisément votre quartier, votre ville ou votre région grâce à nos algorithmes d'ancrage géographique précis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Comment ça marche Section -->
    <section class="py-section-margin">
        <div class="max-w-container-max-width mx-auto px-gutter">
            <h2 class="font-h1 text-h1 text-center mb-20 text-on-surface">Votre article en 4 étapes</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                <div class="hidden md:block absolute top-1/4 left-[10%] right-[10%] h-[2px] bg-outline-variant/20 -z-10"></div>
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-primary text-on-primary flex items-center justify-center font-h2 shadow-md">1</div>
                    <h4 class="font-h3 text-on-surface">Le Sujet</h4>
                    <p class="text-body-sm text-on-surface-variant">Entrez le thème principal ou le titre de votre article.</p>
                </div>
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-primary text-on-primary flex items-center justify-center font-h2 shadow-md">2</div>
                    <h4 class="font-h3 text-on-surface">La Cible</h4>
                    <p class="text-body-sm text-on-surface-variant">Définissez votre zone géographique d'intervention.</p>
                </div>
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-primary text-on-primary flex items-center justify-center font-h2 shadow-md">3</div>
                    <h4 class="font-h3 text-on-surface">La Magie</h4>
                    <p class="text-body-sm text-on-surface-variant">L'IA génère et optimise votre contenu en quelques secondes.</p>
                </div>
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-primary text-on-primary flex items-center justify-center font-h2 shadow-md">4</div>
                    <h4 class="font-h3 text-on-surface">Publication</h4>
                    <p class="text-body-sm text-on-surface-variant">Validez et publiez directement sur votre blog ou site.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tarifs Section -->
    <section id="pricing" class="py-section-margin bg-surface-container">
        <div class="max-w-container-max-width mx-auto px-gutter">
            <div class="text-center mb-16">
                <h2 class="font-h1 text-h1 mb-4 text-on-surface">Choisissez votre plan de croissance</h2>
                <p class="text-on-surface-variant">Des tarifs simples et transparents, sans engagement.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-end">
                <!-- Free -->
                <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/30 flex flex-col h-full">
                    <span class="font-label text-on-surface-variant uppercase mb-4">Gratuit</span>
                    <div class="mb-6">
                        <span class="text-h1 font-h1">0€</span>
                        <span class="text-on-surface-variant">/mois</span>
                    </div>
                    <ul class="space-y-4 mb-10 flex-grow">
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                            2 articles par mois
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                            Optimisation locale basique
                        </li>
                        <li class="flex items-center gap-2 text-body-sm opacity-40">
                            <span class="material-symbols-outlined text-sm">block</span>
                            Analytics avancés
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="w-full border border-primary text-primary py-3 rounded-lg font-label hover:bg-primary-fixed transition-colors text-center">Démarrer</a>
                </div>
                <!-- Pro (Popular) -->
                <div class="bg-surface-container-lowest p-8 rounded-xl border-2 border-primary ring-4 ring-primary/5 flex flex-col h-full relative scale-105 shadow-xl">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-4 py-1 rounded-full text-[12px] font-bold">POPULAIRE</div>
                    <span class="font-label text-on-surface-variant uppercase mb-4">Pro</span>
                    <div class="mb-6">
                        <span class="text-h1 font-h1">29€</span>
                        <span class="text-on-surface-variant">/mois</span>
                    </div>
                    <ul class="space-y-4 mb-10 flex-grow">
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            15 articles par mois
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            IA Premium multilingue
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Analytics &amp; Rapport mensuel
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Support prioritaire
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="w-full bg-primary text-on-primary py-3 rounded-lg font-label hover:bg-primary-container transition-all text-center">Choisir Pro</a>
                </div>
                <!-- Business -->
                <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/30 flex flex-col h-full">
                    <span class="font-label text-on-surface-variant uppercase mb-4">Business</span>
                    <div class="mb-6">
                        <span class="text-h1 font-h1">89€</span>
                        <span class="text-on-surface-variant">/mois</span>
                    </div>
                    <ul class="space-y-4 mb-10 flex-grow">
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                            Articles illimités
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                            Gestion multi-sites
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                            Accès API &amp; Intégrations
                        </li>
                        <li class="flex items-center gap-2 text-body-sm">
                            <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                            Account Manager dédié
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="w-full border border-primary text-primary py-3 rounded-lg font-label hover:bg-primary-fixed transition-colors text-center">Contacter la vente</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24">
        <div class="max-w-container-max-width mx-auto px-gutter">
            <div class="bg-inverse-surface rounded-3xl p-12 md:p-20 text-center relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-surface-bright font-h1 text-[40px] mb-6">Prêt à dominer votre recherche locale ?</h2>
                    <p class="text-inverse-on-surface/80 font-body mb-10 max-w-[600px] mx-auto">Rejoignez les centaines de commerçants qui ont déjà boosté leur visibilité de 300% avec NEARSEO.</p>
                    <a href="{{ route('register') }}" class="bg-primary text-on-primary px-10 py-5 rounded-full font-h3 hover:scale-105 transition-transform active:scale-95 inline-block">
                        Essayer gratuitement pendant 14 jours
                    </a>
                </div>
                <div class="absolute -top-1/2 -left-1/4 w-full h-full bg-primary/20 blur-[120px] pointer-events-none"></div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-surface-container-lowest dark:bg-inverse-surface w-full py-section-margin border-t border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-stack-gap-md mb-12">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
    <img src="{{ asset('logo.png') }}" 
         alt="NEARSEO Logo" 
         class="w-8 h-8 object-contain"
         style="filter: drop-shadow(0 1px 2px rgba(0,0,0,0.1));">
</div>
                <p class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 max-w-[200px]">
                    L'intelligence artificielle au service de votre référencement local.
                </p>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary dark:text-primary-fixed-dim uppercase">Produit</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#features">Fonctionnalités</a>
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#pricing">Tarifs</a>
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Nouveautés</a>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary dark:text-primary-fixed-dim uppercase">Ressources</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Blog</a>
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Guides SEO</a>
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Documentation</a>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary dark:text-primary-fixed-dim uppercase">Contact</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Support</a>
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Partenaires</a>
                    <a class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 hover:text-primary dark:hover:text-tertiary-fixed-dim underline transition-all" href="#">Sales</a>
                </nav>
            </div>
        </div>
        <div class="pt-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-sm text-on-surface-variant dark:text-on-surface-variant/70 text-center">
                © 2024 NEARSEO. Tous droits réservés. Expertise locale &amp; IA.
            </p>
            <div class="flex gap-6">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">language</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">share</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">policy</span></a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Simple scroll observer for header transparency
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 20) {
            header.classList.add('shadow-sm');
        } else {
            header.classList.remove('shadow-sm');
        }
    });

    // Hover micro-interactions for pricing cards
    const cards = document.querySelectorAll('.bg-surface-container-lowest');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            if (!card.classList.contains('scale-105')) {
                card.style.transform = 'translateY(-8px)';
            }
        });
        card.addEventListener('mouseleave', () => {
            if (!card.classList.contains('scale-105')) {
                card.style.transform = 'translateY(0px)';
            }
        });
    });
</script>

</body>
</html>