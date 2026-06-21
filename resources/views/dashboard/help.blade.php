{{-- resources/views/dashboard/help.blade.php --}}
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="Centre d'aide NEARSEO - Guides et ressources pour maîtriser votre SEO local"/>
    <meta name="robots" content="noindex, follow"/>
    <title>Centre d'aide - NEARSEO</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed-dim": "#ffb77c",
                        "on-secondary": "#ffffff",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#adcfae",
                        "on-secondary-container": "#4d6c50",
                        "surface-variant": "#d1e4fb",
                        "surface": "#f7f9ff",
                        "primary-fixed": "#ffdbce",
                        "secondary": "#47664b",
                        "on-tertiary": "#ffffff",
                        "on-primary": "#ffffff",
                        "surface-tint": "#8e4c31",
                        "surface-dim": "#c9dcf3",
                        "primary": "#8c4a2f",
                        "on-tertiary-fixed": "#2e1500",
                        "outline": "#86736c",
                        "secondary-fixed": "#c9ecc9",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "primary-container": "#a96245",
                        "surface-container-high": "#d9eaff",
                        "on-primary-fixed-variant": "#71361c",
                        "on-primary-container": "#fffbff",
                        "tertiary-fixed": "#ffdcc2",
                        "primary-fixed-dim": "#ffb599",
                        "on-tertiary-container": "#fffbff",
                        "error": "#ba1a1a",
                        "on-secondary-fixed-variant": "#304d34",
                        "inverse-on-surface": "#e8f2ff",
                        "background": "#f7f9ff",
                        "surface-container-low": "#edf4ff",
                        "on-primary-fixed": "#370e00",
                        "tertiary-container": "#b06000",
                        "on-background": "#091d2e",
                        "inverse-primary": "#ffb599",
                        "surface-container-highest": "#d1e4fb",
                        "on-surface-variant": "#53433d",
                        "on-error": "#ffffff",
                        "on-surface": "#091d2e",
                        "on-secondary-fixed": "#03210c",
                        "surface-container": "#e3efff",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#8c4b00",
                        "surface-bright": "#f7f9ff",
                        "secondary-container": "#c9ecc9",
                        "inverse-surface": "#203243",
                        "outline-variant": "#d9c2ba",
                        "error-container": "#ffdad6"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
                    },
                    spacing: {
                        "container-max-width": "1280px",
                        "stack-gap-md": "16px",
                        "card-padding": "24px",
                        "stack-gap-sm": "8px",
                        "section-margin": "32px",
                        "gutter": "16px"
                    },
                    fontFamily: {
                        h2: ["Inter"],
                        "h1-mobile": ["Inter"],
                        "body-sm": ["Inter"],
                        h3: ["Inter"],
                        label: ["Inter"],
                        h1: ["Inter"],
                        body: ["Inter"]
                    },
                    fontSize: {
                        h2: ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "h1-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        h3: ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        label: ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        h1: ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        body: ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #f7f9ff;
            color: #091d2e;
            font-family: 'Inter', sans-serif;
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }
        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(201, 124, 93, 0.05) 0%, transparent 70%);
        }
        .tonal-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .tonal-card:hover {
            box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-body text-body">

<!-- TopAppBar (IDENTIQUE À COMMUNITY) -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter flex justify-between items-center h-24">
        
        <!-- Logo agrandi -->
        <div class="flex items-center">
            <img src="{{ asset('logo.png') }}" 
                 alt="NEARSEO Logo" 
                 class="h-16 w-auto md:h-20 object-contain"
                 onerror="this.src='{{ asset('images/logo.png') }}'">
        </div>
        
        <!-- Navigation desktop -->
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('landing') }}#features">Fonctionnalités</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('landing') }}#pricing">Tarifs</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('community') }}">Communauté</a>
            <a class="text-primary font-body text-body font-bold border-b-2 border-primary pb-1 flex items-center gap-1" href="{{ route('help') }}">
                <span class="material-symbols-outlined text-sm">help_outline</span>
                Aide
            </a>
            <a href="{{ route('login') }}" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors">Connexion</a>
        </nav>
        
        <!-- CTA Button -->
        <a href="{{ route('register') }}" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-label transition-all active:scale-95 whitespace-nowrap">
            Essai gratuit
        </a>
    </div>
</header>

<main class="pt-24">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-section-margin hero-gradient">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center text-center gap-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary/10 text-secondary rounded-full">
                <span class="material-symbols-outlined text-[18px]">help_outline</span>
                <span class="font-label text-label">CENTRE D'AIDE</span>
            </div>
            <h1 class="font-h1 text-h1 md:text-[56px] leading-[1.1] text-on-background max-w-3xl">
                Comment pouvons-nous vous <span class="text-primary">aider</span> ?
            </h1>
            <p class="font-body text-body text-on-surface-variant max-w-2xl">
                Retrouvez ici tous les guides et ressources pour maîtriser NEARSEO et booster votre SEO local.
            </p>
            
            <!-- Barre de recherche -->
            <div class="mt-4 w-full max-w-xl">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input type="text" 
                           id="helpSearch" 
                           placeholder="Rechercher dans l'aide..." 
                           class="w-full pl-12 pr-4 py-4 bg-white border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-on-surface placeholder-on-surface-variant shadow-sm">
                </div>
            </div>
        </div>
    </section>

    <!-- Catégories principales -->
    <section class="py-section-margin bg-surface">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="font-h1 text-h1 text-on-background">Explorez par catégorie</h2>
                <p class="font-body text-body text-on-surface-variant max-w-2xl mx-auto">Choisissez la thématique qui correspond à vos besoins</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Articles -->
                <a href="#articles" class="group bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">article</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-3 text-on-surface">Articles</h3>
                    <p class="font-body text-body text-gray-500">Créer, gérer et optimiser vos articles pour un meilleur référencement</p>
                    <div class="mt-4 flex items-center gap-2 text-primary font-medium">
                        <span>Voir les guides</span>
                        <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </a>

                <!-- IA -->
                <a href="#ai" class="group bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">auto_awesome</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-3 text-on-surface">Intelligence Artificielle</h3>
                    <p class="font-body text-body text-gray-500">Générer, réécrire et optimiser vos contenus avec l'IA</p>
                    <div class="mt-4 flex items-center gap-2 text-secondary font-medium">
                        <span>Voir les guides</span>
                        <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </a>

                <!-- Géolocalisation -->
                <a href="#geo" class="group bg-white p-8 rounded-2xl border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-tertiary/10 rounded-xl flex items-center justify-center text-tertiary mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">location_on</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-3 text-on-surface">Géolocalisation</h3>
                    <p class="font-body text-body text-gray-500">Cibler vos articles géographiquement pour un SEO local</p>
                    <div class="mt-4 flex items-center gap-2 text-tertiary font-medium">
                        <span>Voir les guides</span>
                        <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Section Articles -->
    <section id="articles" class="py-section-margin bg-surface-container-low scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-8">
                <span class="material-symbols-outlined text-3xl text-primary">article</span>
                <h2 class="font-h1 text-h1 text-on-background">Guide des articles</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl border border-gray-100 hover:border-primary/30 transition tonal-card">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">add_circle</span>
                        <div>
                            <h4 class="font-h3 text-h3 text-on-surface">Créer un article</h4>
                            <p class="text-body text-gray-500 mt-1">Allez dans Articles → Nouvel article. Remplissez le titre, le contenu et les métadonnées.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-100 hover:border-primary/30 transition tonal-card">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">edit</span>
                        <div>
                            <h4 class="font-h3 text-h3 text-on-surface">Modifier un article</h4>
                            <p class="text-body text-gray-500 mt-1">Ouvrez l'article depuis la liste et cliquez sur "Modifier". Toutes les modifications sont sauvegardées automatiquement.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-100 hover:border-primary/30 transition tonal-card">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">publish</span>
                        <div>
                            <h4 class="font-h3 text-h3 text-on-surface">Publier un article</h4>
                            <p class="text-body text-gray-500 mt-1">Une fois l'article prêt, changez son statut de "Brouillon" à "Publié" et il sera visible par tous.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-100 hover:border-primary/30 transition tonal-card">
                    <div class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary">analytics</span>
                        <div>
                            <h4 class="font-h3 text-h3 text-on-surface">Analyser les performances</h4>
                            <p class="text-body text-gray-500 mt-1">Consultez le dashboard pour voir les vues, le score SEO et l'engagement de vos articles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section IA -->
    <section id="ai" class="py-section-margin bg-surface scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-8">
                <span class="material-symbols-outlined text-3xl text-secondary">auto_awesome</span>
                <h2 class="font-h1 text-h1 text-on-background">Guide de l'IA</h2>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-8 tonal-card">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 rounded-xl bg-gray-50">
                        <span class="material-symbols-outlined text-4xl text-primary">auto_stories</span>
                        <h4 class="font-h3 text-h3 text-on-surface mt-3">Générer</h4>
                        <p class="text-body text-gray-500 mt-1">Créez un article complet à partir d'un sujet</p>
                        <div class="mt-4 inline-flex items-center gap-1 text-sm text-primary font-medium">
                            <span>Essayez</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                    <div class="text-center p-6 rounded-xl bg-gray-50">
                        <span class="material-symbols-outlined text-4xl text-secondary">edit_note</span>
                        <h4 class="font-h3 text-h3 text-on-surface mt-3">Réécrire</h4>
                        <p class="text-body text-gray-500 mt-1">Améliorez et reformulez un texte existant</p>
                        <div class="mt-4 inline-flex items-center gap-1 text-sm text-secondary font-medium">
                            <span>Essayez</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                    <div class="text-center p-6 rounded-xl bg-gray-50">
                        <span class="material-symbols-outlined text-4xl text-tertiary">trending_up</span>
                        <h4 class="font-h3 text-h3 text-on-surface mt-3">Optimiser</h4>
                        <p class="text-body text-gray-500 mt-1">Améliorez le SEO et la structure du contenu</p>
                        <div class="mt-4 inline-flex items-center gap-1 text-sm text-tertiary font-medium">
                            <span>Essayez</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-primary/5 rounded-xl border border-primary/10">
                    <p class="text-body text-gray-600">
                        💡 <span class="font-medium">Astuce :</span> L'IA est accessible depuis le menu "Stratégie de contenu". Testez les différentes options pour trouver celle qui correspond à vos besoins.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Géolocalisation -->
    <section id="geo" class="py-section-margin bg-surface-container-low scroll-mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-8">
                <span class="material-symbols-outlined text-3xl text-tertiary">location_on</span>
                <h2 class="font-h1 text-h1 text-on-background">Guide de géolocalisation</h2>
            </div>
            <div class="bg-white rounded-2xl border border-gray-100 p-8 tonal-card">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-h3 text-h3 text-on-surface">Pourquoi utiliser la géolocalisation ?</h4>
                        <p class="text-body text-gray-500 mt-2">
                            La géolocalisation permet de cibler des zones géographiques spécifiques dans vos articles.
                            Cela améliore votre référencement local et attire des lecteurs de votre région.
                        </p>
                        <div class="mt-4 p-4 bg-secondary/5 rounded-xl border border-secondary/10">
                            <p class="text-sm text-secondary font-medium">📈 +85% de visibilité locale en moyenne</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-h3 text-h3 text-on-surface">Comment l'utiliser ?</h4>
                        <ol class="mt-2 space-y-3 text-body text-gray-500">
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-bold flex-shrink-0">1</span>
                                <span>Allez dans la section <span class="font-medium text-on-surface">"Géolocalisation"</span></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-bold flex-shrink-0">2</span>
                                <span>Recherchez une <span class="font-medium text-on-surface">adresse ou une ville</span></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-bold flex-shrink-0">3</span>
                                <span>Sélectionnez le <span class="font-medium text-on-surface">rayon autour de la zone</span></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-bold flex-shrink-0">4</span>
                                <span>Appliquez la <span class="font-medium text-on-surface">localisation à votre article</span></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-section-margin bg-surface">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="material-symbols-outlined text-4xl text-primary">quiz</span>
                <h2 class="font-h1 text-h1 text-on-background mt-4">Foire aux questions</h2>
                <p class="font-body text-body text-on-surface-variant">Les réponses aux questions les plus fréquentes</p>
            </div>
            <div class="space-y-4">
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden tonal-card">
                    <button onclick="toggleFaq(this)" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition">
                        <span class="font-h3 text-h3 text-on-surface">Comment changer mon mot de passe ?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-4 text-body text-gray-500">
                        Allez dans <span class="font-medium text-on-surface">Paramètres</span> → <span class="font-medium text-on-surface">Sécurité</span>, puis remplissez le formulaire avec votre mot de passe actuel et le nouveau.
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden tonal-card">
                    <button onclick="toggleFaq(this)" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition">
                        <span class="font-h3 text-h3 text-on-surface">Comment optimiser mes articles pour le SEO ?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-4 text-body text-gray-500">
                        Utilisez des mots-clés pertinents, structurez votre contenu avec des titres (H1, H2, H3), ajoutez des images et des balises meta. L'outil d'analyse SEO intégré vous donne des recommandations en temps réel.
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden tonal-card">
                    <button onclick="toggleFaq(this)" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition">
                        <span class="font-h3 text-h3 text-on-surface">Comment utiliser l'IA pour générer du contenu ?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-4 text-body text-gray-500">
                        Allez dans <span class="font-medium text-on-surface">Stratégie de contenu</span>, choisissez "Générer", "Réécrire" ou "Optimiser". L'IA vous proposera un contenu adapté à votre thématique.
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden tonal-card">
                    <button onclick="toggleFaq(this)" class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition">
                        <span class="font-h3 text-h3 text-on-surface">Comment supprimer mon compte ?</span>
                        <span class="material-symbols-outlined text-gray-400 transition-transform duration-200">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-4 text-body text-gray-500">
                        Allez dans <span class="font-medium text-on-surface">Profil</span> → <span class="font-medium text-on-surface">Supprimer le compte</span>. Cette action est définitive et irréversible.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA Section (COMME DANS COMMUNITY) -->
    <section class="max-w-7xl mx-auto px-6 mb-section-margin">
        <div class="bg-primary/5 p-12 md:p-16 rounded-[40px] text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-tertiary rounded-full translate-x-1/3 translate-y-1/3"></div>
            </div>
            <div class="relative z-10 max-w-2xl mx-auto flex flex-col gap-6">
                <span class="material-symbols-outlined text-5xl text-primary">support_agent</span>
                <h2 class="font-h1 text-[40px] md:text-[48px] text-on-background">Besoin d'aide supplémentaire ?</h2>
                <p class="text-body text-on-surface-variant">
                    Notre équipe est là pour vous accompagner. Contactez-nous et nous vous répondrons sous 24h.
                </p>
                <div class="flex flex-col md:flex-row gap-4 w-full max-w-xl mx-auto">
                    <a href="mailto:support@nearseo.com" class="flex-1 bg-primary text-white px-8 py-4 rounded-full font-label hover:bg-primary/90 transition-all active:scale-95 shadow-lg flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">email</span>
                        Contacter le support
                    </a>
                    <a href="{{ route('dashboard') }}" class="flex-1 border-2 border-primary text-primary px-8 py-4 rounded-full font-label hover:bg-primary/5 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">dashboard</span>
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer (IDENTIQUE À COMMUNITY) -->
<footer class="bg-surface-container-lowest w-full py-section-margin border-t border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-stack-gap-md mb-12">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" 
                         alt="NEARSEO Logo" 
                         class="h-12 w-auto"
                         onerror="this.src='{{ asset('images/logo.png') }}'">
                </div>
                <p class="font-body-sm text-on-surface-variant max-w-[200px]">Votre agent SEO local au Maroc.</p>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Produit</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="{{ route('landing') }}#features">Fonctionnalités</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="{{ route('landing') }}#pricing">Tarifs</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Nouveautés</a>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Ressources</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="{{ route('community') }}">Communauté</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Guides SEO</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Documentation</a>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Contact</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Support</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Partenaires</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Sales</a>
                </nav>
            </div>
        </div>
        <div class="pt-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-sm text-on-surface-variant text-center">© {{ date('Y') }} NEARSEO. Votre agent SEO local au Maroc.</p>
            <div class="flex gap-6">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">language</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">share</span></a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#"><span class="material-symbols-outlined">policy</span></a>
            </div>
        </div>
    </div>
</footer>

<script>
    // Header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 20) {
            header.classList.add('shadow-md');
        } else {
            header.classList.remove('shadow-md');
        }
    });

    // FAQ Toggle
    function toggleFaq(button) {
        const answer = button.nextElementSibling;
        const icon = button.querySelector('.material-symbols-outlined:last-child');
        answer.classList.toggle('hidden');
        icon.style.transform = answer.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    // Recherche dans l'aide
    document.getElementById('helpSearch')?.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        const sections = document.querySelectorAll('[id^="articles"], [id^="ai"], [id^="geo"]');
        
        sections.forEach(section => {
            const text = section.textContent.toLowerCase();
            if (query === '') {
                section.style.display = '';
            } else {
                section.style.display = text.includes(query) ? '' : 'none';
            }
        });
    });

    // Hover animation for cards
    document.querySelectorAll('.tonal-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-2px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Button micro-interactions
    document.querySelectorAll('button, a').forEach(button => {
        button.addEventListener('mousedown', () => {
            if (!button.closest('a') || button.closest('a').getAttribute('href')?.startsWith('#')) {
                button.style.transform = 'scale(0.96)';
            }
        });
        button.addEventListener('mouseup', () => {
            button.style.transform = '';
        });
        button.addEventListener('mouseleave', () => {
            button.style.transform = '';
        });
    });
</script>
</body>
</html>