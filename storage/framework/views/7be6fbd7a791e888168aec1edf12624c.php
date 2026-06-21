
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Communauté NEARSEO | Expertise SEO Locale & IA</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind Configuration -->
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
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }
        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(201, 124, 93, 0.05) 0%, transparent 70%);
        }
        .ai-border {
            border-left: 4px solid #47664b;
            background-color: #F0F4F0;
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
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        /* Couleurs des catégories */
        .cat-tourisme { background-color: #dbeafe; color: #1e40af; }
        .cat-ecommerce { background-color: #d1fae5; color: #065f46; }
        .cat-gastronomie { background-color: #fef3c7; color: #92400e; }
        .cat-immobilier { background-color: #ede9fe; color: #5b21b6; }
        .cat-sante { background-color: #fce4ec; color: #9a3412; }
        .cat-mode { background-color: #fce7f3; color: #9d174d; }
        .cat-tech { background-color: #e0e7ff; color: #3730a3; }
        .cat-artisanat { background-color: #ffedd5; color: #9a3412; }
        .cat-sport { background-color: #dcfce7; color: #166534; }
        .cat-culture { background-color: #f3e8ff; color: #6b21a8; }
        .cat-education { background-color: #fef9c3; color: #854d0e; }
        .cat-automobile { background-color: #e5e7eb; color: #1f2937; }
    </style>
</head>
<body class="font-body text-body">

<!-- TopAppBar (IDENTIQUE À LA LANDING) -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter flex justify-between items-center h-24">
        
        <!-- Logo agrandi -->
        <div class="flex items-center">
            <img src="<?php echo e(asset('logo.png')); ?>" 
                 alt="NEARSEO Logo" 
                 class="h-16 w-auto md:h-20 object-contain"
                 onerror="this.src='<?php echo e(asset('images/logo.png')); ?>'">
        </div>
        
        <!-- Navigation desktop -->
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="<?php echo e(route('landing')); ?>#features">Fonctionnalités</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="<?php echo e(route('landing')); ?>#pricing">Tarifs</a>
            <a class="text-primary font-body text-body font-bold border-b-2 border-primary pb-1" href="<?php echo e(route('community')); ?>">Communauté</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors flex items-center gap-1" href="<?php echo e(route('help')); ?>">
                Aide
            </a>
            <a href="<?php echo e(route('login')); ?>" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors">Connexion</a>
        </nav>
        
        <!-- CTA Button -->
        <a href="<?php echo e(route('register')); ?>" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-label transition-all active:scale-95 whitespace-nowrap">
            Essai gratuit
        </a>
    </div>
</header>

<main class="pt-24">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-section-margin hero-gradient">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center text-center gap-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary/10 text-secondary rounded-full">
                <span class="material-symbols-outlined text-[18px]">stars</span>
                <span class="font-label text-label">ORGANIC INTELLIGENCE</span>
            </div>
            <h1 class="font-h1 text-h1 md:text-[56px] leading-[1.1] text-on-background max-w-3xl">
                Communauté <span class="text-primary">NEARSEO</span>
            </h1>
            <p class="font-body text-body text-on-surface-variant max-w-2xl">
                Rejoignez le premier écosystème d'experts en SEO local. Alliez l'intuition humaine à la puissance de l'IA pour dominer vos marchés régionaux.
            </p>
        </div>
    </section>

    <!-- Filtering System avec listes déroulantes -->
    <div class="sticky top-24 z-40 bg-background/80 backdrop-blur-md border-b border-outline-variant">
        <div class="max-w-7xl mx-auto px-6 py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Pays -->
                <div>
                    <label class="font-label text-on-surface-variant text-sm block mb-1">PAYS</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">public</span>
                        <select id="country-select" class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded-lg text-on-surface-variant focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none font-label cursor-pointer transition-all appearance-none">
                            <option value="all">Tous les pays</option>
                            <option value="Maroc">🇲🇦 Maroc</option>
                            <option value="France">🇫🇷 France</option>
                            <option value="Belgique">🇧🇪 Belgique</option>
                            <option value="Suisse">🇨🇭 Suisse</option>
                            <option value="Canada">🇨🇦 Canada</option>
                            <option value="Espagne">🇪🇸 Espagne</option>
                            <option value="Italie">🇮🇹 Italie</option>
                            <option value="Allemagne">🇩🇪 Allemagne</option>
                            <option value="Portugal">🇵🇹 Portugal</option>
                            <option value="Pays-Bas">🇳🇱 Pays-Bas</option>
                            <option value="Royaume-Uni">🇬🇧 Royaume-Uni</option>
                            <option value="États-Unis">🇺🇸 États-Unis</option>
                            <option value="Sénégal">🇸🇳 Sénégal</option>
                            <option value="Côte d'Ivoire">🇨🇮 Côte d'Ivoire</option>
                            <option value="Tunisie">🇹🇳 Tunisie</option>
                            <option value="Algérie">🇩🇿 Algérie</option>
                            <option value="Égypte">🇪🇬 Égypte</option>
                            <option value="Turquie">🇹🇷 Turquie</option>
                            <option value="Émirats Arabes Unis">🇦🇪 Émirats Arabes Unis</option>
                            <option value="Arabie Saoudite">🇸🇦 Arabie Saoudite</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant text-sm">expand_more</span>
                    </div>
                </div>

                <!-- Ville -->
                <div>
                    <label class="font-label text-on-surface-variant text-sm block mb-1">VILLE</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-sm">location_on</span>
                        <select id="city-select" class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded-lg text-on-surface-variant focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none font-label cursor-pointer transition-all appearance-none">
                            <option value="all"> Toutes les villes</option>
                            <!-- Maroc -->
                            <option value="Casablanca" data-country="Maroc">Casablanca, Maroc</option>
                            <option value="Marrakech" data-country="Maroc">Marrakech, Maroc</option>
                            <option value="Rabat" data-country="Maroc">Rabat, Maroc</option>
                            <option value="Tanger" data-country="Maroc">Tanger, Maroc</option>
                            <option value="Agadir" data-country="Maroc">Agadir, Maroc</option>
                            <option value="Fes" data-country="Maroc">Fès, Maroc</option>
                            <option value="Meknes" data-country="Maroc">Meknès, Maroc</option>
                            <option value="Oujda" data-country="Maroc">Oujda, Maroc</option>
                            <option value="Kenitra" data-country="Maroc">Kénitra, Maroc</option>
                            <option value="Tetouan" data-country="Maroc">Tétouan, Maroc</option>
                            <!-- France -->
                            <option value="Paris" data-country="France">Paris, France</option>
                            <option value="Lyon" data-country="France">Lyon, France</option>
                            <option value="Marseille" data-country="France">Marseille, France</option>
                            <option value="Nice" data-country="France">Nice, France</option>
                            <option value="Bordeaux" data-country="France">Bordeaux, France</option>
                            <option value="Toulouse" data-country="France">Toulouse, France</option>
                            <option value="Lille" data-country="France">Lille, France</option>
                            <option value="Strasbourg" data-country="France">Strasbourg, France</option>
                            <!-- Belgique -->
                            <option value="Bruxelles" data-country="Belgique">Bruxelles, Belgique</option>
                            <option value="Anvers" data-country="Belgique">Anvers, Belgique</option>
                            <option value="Gand" data-country="Belgique">Gand, Belgique</option>
                            <option value="Liege" data-country="Belgique">Liège, Belgique</option>
                            <!-- Suisse -->
                            <option value="Geneve" data-country="Suisse">Genève, Suisse</option>
                            <option value="Zurich" data-country="Suisse">Zurich, Suisse</option>
                            <option value="Lausanne" data-country="Suisse">Lausanne, Suisse</option>
                            <option value="Berne" data-country="Suisse">Berne, Suisse</option>
                            <!-- Canada -->
                            <option value="Montreal" data-country="Canada">Montréal, Canada</option>
                            <option value="Quebec" data-country="Canada">Québec, Canada</option>
                            <option value="Toronto" data-country="Canada">Toronto, Canada</option>
                            <option value="Vancouver" data-country="Canada">Vancouver, Canada</option>
                            <!-- Espagne -->
                            <option value="Madrid" data-country="Espagne">Madrid, Espagne</option>
                            <option value="Barcelone" data-country="Espagne">Barcelone, Espagne</option>
                            <option value="Valence" data-country="Espagne">Valence, Espagne</option>
                            <option value="Seville" data-country="Espagne">Séville, Espagne</option>
                            <!-- Italie -->
                            <option value="Rome" data-country="Italie">Rome, Italie</option>
                            <option value="Milan" data-country="Italie">Milan, Italie</option>
                            <option value="Florence" data-country="Italie">Florence, Italie</option>
                            <option value="Naples" data-country="Italie">Naples, Italie</option>
                            <!-- Allemagne -->
                            <option value="Berlin" data-country="Allemagne">Berlin, Allemagne</option>
                            <option value="Munich" data-country="Allemagne">Munich, Allemagne</option>
                            <option value="Hambourg" data-country="Allemagne">Hambourg, Allemagne</option>
                            <option value="Francfort" data-country="Allemagne">Francfort, Allemagne</option>
                            <!-- Portugal -->
                            <option value="Lisbonne" data-country="Portugal">Lisbonne, Portugal</option>
                            <option value="Porto" data-country="Portugal">Porto, Portugal</option>
                            <!-- Pays-Bas -->
                            <option value="Amsterdam" data-country="Pays-Bas">Amsterdam, Pays-Bas</option>
                            <option value="Rotterdam" data-country="Pays-Bas">Rotterdam, Pays-Bas</option>
                            <!-- Royaume-Uni -->
                            <option value="Londres" data-country="Royaume-Uni">Londres, Royaume-Uni</option>
                            <option value="Manchester" data-country="Royaume-Uni">Manchester, Royaume-Uni</option>
                            <!-- États-Unis -->
                            <option value="New York" data-country="États-Unis">New York, États-Unis</option>
                            <option value="Los Angeles" data-country="États-Unis">Los Angeles, États-Unis</option>
                            <option value="San Francisco" data-country="États-Unis">San Francisco, États-Unis</option>
                            <option value="Chicago" data-country="États-Unis">Chicago, États-Unis</option>
                            <!-- Afrique -->
                            <option value="Dakar" data-country="Sénégal">Dakar, Sénégal</option>
                            <option value="Abidjan" data-country="Côte d'Ivoire">Abidjan, Côte d'Ivoire</option>
                            <option value="Tunis" data-country="Tunisie">Tunis, Tunisie</option>
                            <option value="Alger" data-country="Algérie">Alger, Algérie</option>
                            <option value="Le Caire" data-country="Égypte">Le Caire, Égypte</option>
                            <!-- Moyen-Orient -->
                            <option value="Istanbul" data-country="Turquie">Istanbul, Turquie</option>
                            <option value="Dubai" data-country="Émirats Arabes Unis">Dubaï, Émirats Arabes Unis</option>
                            <option value="Riyad" data-country="Arabie Saoudite">Riyad, Arabie Saoudite</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant text-sm">expand_more</span>
                    </div>
                </div>

                <!-- Filtrer -->
                <div class="flex items-end">
                    <button onclick="applyFilters()" class="w-full bg-primary text-on-primary px-6 py-2 rounded-lg font-bold flex items-center justify-center gap-2 hover:shadow-lg transition-all active:scale-95">
                        <span class="material-symbols-outlined text-sm">search</span>
                        <span>Filtrer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Grid -->
    <section class="max-w-7xl mx-auto px-6 py-section-margin">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="articles-grid">
            <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $categories = [
                    'Tourisme' => ['label' => 'TOURISME', 'class' => 'cat-tourisme'],
                    'E-commerce' => ['label' => 'E-COMMERCE', 'class' => 'cat-ecommerce'],
                    'Gastronomie' => ['label' => 'GASTRONOMIE', 'class' => 'cat-gastronomie'],
                    'Immobilier' => ['label' => 'IMMOBILIER', 'class' => 'cat-immobilier'],
                    'Santé' => ['label' => 'SANTÉ', 'class' => 'cat-sante'],
                    'Mode' => ['label' => 'MODE', 'class' => 'cat-mode'],
                    'Tech' => ['label' => 'TECH', 'class' => 'cat-tech'],
                    'Artisanat' => ['label' => 'ARTISANAT', 'class' => 'cat-artisanat'],
                    'Sport' => ['label' => 'SPORT', 'class' => 'cat-sport'],
                    'Culture' => ['label' => 'CULTURE', 'class' => 'cat-culture'],
                    'Éducation' => ['label' => 'ÉDUCATION', 'class' => 'cat-education'],
                    'Automobile' => ['label' => 'AUTOMOBILE', 'class' => 'cat-automobile'],
                ];
                
                // Utiliser la catégorie de l'article ou une valeur par défaut
                $cat = isset($article->category) && isset($categories[$article->category]) 
                    ? $categories[$article->category] 
                    : ['label' => 'ARTICLE', 'class' => 'bg-gray-100 text-gray-700'];
                
                // Définir le pays par défaut si vide
                $country = !empty($article->geo_pays) ? $article->geo_pays : 'Maroc';
                $city = !empty($article->city) ? $article->city : '';
            ?>
            <article class="tonal-card overflow-hidden rounded-xl" data-country="<?php echo e($country); ?>" data-city="<?php echo e($city); ?>">
                <div class="h-56 relative">
                    <div class="absolute top-4 left-4 z-10 px-3 py-1 rounded-lg font-label text-label shadow-sm <?php echo e($cat['class']); ?> bg-opacity-90">
                        <?php echo e($cat['label']); ?>

                    </div>
                    <div class="absolute top-4 right-4 z-10 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-lg font-label text-label flex items-center gap-1 shadow-sm">
                        <span class="material-symbols-outlined text-[14px]">bolt</span> 
                        <?php echo e($article->seo_score ?? 0); ?>%
                    </div>
                    
                    <?php if($article->image): ?>
                    <img class="w-full h-full object-cover" src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>">
                    <?php else: ?>
                    <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/30">article</span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="p-card-padding flex flex-col gap-stack-gap-md h-full">
                    <div class="ai-border p-3 rounded-r-lg">
                        <span class="font-label text-secondary block mb-1">STRATÉGIE LOCALE</span>
                        <h3 class="font-h3 text-h3 text-on-surface group-hover:text-primary transition-colors">
                            <a href="<?php echo e(route('blog.user.article', ['slug' => auth()->user()->slug ?? 'admin-nearseo', 'articleSlug' => $article->slug])); ?>" class="hover:text-primary transition-colors">
                                <?php echo e(Str::limit($article->title, 60)); ?>

                            </a>
                        </h3>
                    </div>
                    <p class="text-on-surface-variant text-body-sm line-clamp-3">
                        <?php echo e(Str::limit(strip_tags($article->excerpt ?? $article->content), 120)); ?>

                    </p>
                    <div class="mt-auto pt-4 flex justify-between items-center border-t border-outline-variant">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold text-xs">
                                <?php echo e($article->user->name[0] ?? 'A'); ?>

                            </div>
                            <span class="font-label text-body-sm"><?php echo e($article->user->name ?? 'Anonyme'); ?></span>
                        </div>
                        <a href="<?php echo e(route('blog.user.article', ['slug' => auth()->user()->slug ?? 'admin-nearseo', 'articleSlug' => $article->slug])); ?>" 
                           class="text-primary font-bold text-label hover:underline flex items-center gap-1">
                            Lire plus <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30">forum</span>
                <h3 class="text-xl font-bold text-on-surface mt-4">Aucun article</h3>
                <p class="text-on-surface-variant">Soyez le premier à partager une expertise</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($articles->hasPages()): ?>
        <div class="mt-8">
            <?php echo e($articles->links()); ?>

        </div>
        <?php endif; ?>
    </section>

    <!-- Newsletter CTA Section -->
    <section class="max-w-7xl mx-auto px-6 mb-section-margin">
        <div class="bg-primary/5 p-12 md:p-16 rounded-[40px] text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-tertiary rounded-full translate-x-1/3 translate-y-1/3"></div>
            </div>
            <div class="relative z-10 max-w-2xl mx-auto flex flex-col gap-6">
                <h2 class="font-h1 text-[40px] md:text-[48px] text-on-background">Restez à la pointe</h2>
                <p class="text-body text-on-surface-variant">
                    Recevez chaque semaine les dernières tendances de l'IA appliquée au SEO local, directement dans votre boîte mail.
                </p>
                <div class="flex flex-col md:flex-row gap-4 w-full max-w-xl mx-auto">
                    <input type="email" 
                           class="flex-grow bg-white border border-outline-variant rounded-full px-6 py-4 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" 
                           placeholder="Votre adresse email professionnel">
                    <button class="bg-primary text-white px-8 py-4 rounded-full font-label hover:bg-primary/90 transition-all active:scale-95 shadow-lg">
                        S'abonner maintenant
                    </button>
                </div>
                <p class="text-body-sm text-on-surface-variant/70">Rejoignez +5,000 experts déjà inscrits. Sans spam, jamais.</p>
            </div>
        </div>
    </section>
</main>

<!-- Footer (IDENTIQUE À LA LANDING) -->
<footer class="bg-surface-container-lowest w-full py-section-margin border-t border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-stack-gap-md mb-12">
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <img src="<?php echo e(asset('logo.png')); ?>" 
                         alt="NEARSEO Logo" 
                         class="h-12 w-auto"
                         onerror="this.src='<?php echo e(asset('images/logo.png')); ?>'">
                </div>
                <p class="font-body-sm text-on-surface-variant max-w-[200px]">Votre agent SEO local au Maroc.</p>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Produit</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="<?php echo e(route('landing')); ?>#features">Fonctionnalités</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="<?php echo e(route('landing')); ?>#pricing">Tarifs</a>
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#">Nouveautés</a>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <h5 class="font-label text-primary uppercase">Ressources</h5>
                <nav class="flex flex-col gap-2">
                    <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="<?php echo e(route('community')); ?>">Communauté</a>
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
            <p class="font-body-sm text-on-surface-variant text-center">© <?php echo e(date('Y')); ?> NEARSEO. Votre agent SEO local au Maroc.</p>
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

    // Hover animation for cards
    const cards = document.querySelectorAll('.tonal-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // =============================================
    // FILTRES AVEC GESTION DES VALEURS VIDES
    // =============================================
    
    function applyFilters() {
        const countrySelect = document.getElementById('country-select');
        const citySelect = document.getElementById('city-select');
        
        const selectedCountry = countrySelect ? countrySelect.value : 'all';
        const selectedCity = citySelect ? citySelect.value : 'all';
        
        const articles = document.querySelectorAll('#articles-grid article');
        let visibleCount = 0;
        
        articles.forEach(article => {
            // Récupérer les données avec valeurs par défaut
            let country = article.dataset.country || 'Maroc';
            let city = article.dataset.city || '';
            
            let show = true;
            
            // 1. FILTRE PAR PAYS
            if (selectedCountry !== 'all') {
                // Comparaison insensible à la casse
                if (country.toLowerCase() !== selectedCountry.toLowerCase()) {
                    show = false;
                }
            }
            
            // 2. FILTRE PAR VILLE
            if (show && selectedCity !== 'all') {
                // Si la ville de l'article est vide, on ne l'affiche pas
                if (!city || city.toLowerCase() !== selectedCity.toLowerCase()) {
                    show = false;
                }
            }
            
            // Afficher ou cacher l'article
            if (show) {
                article.style.display = '';
                visibleCount++;
            } else {
                article.style.display = 'none';
            }
        });
        
        // Afficher un message si aucun résultat
        let emptyMessage = document.getElementById('empty-message');
        if (visibleCount === 0) {
            if (!emptyMessage) {
                const grid = document.getElementById('articles-grid');
                const msg = document.createElement('div');
                msg.id = 'empty-message';
                msg.className = 'col-span-1 md:col-span-2 lg:col-span-3 text-center py-12';
                msg.innerHTML = `
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/30">search_off</span>
                    <h3 class="text-xl font-bold text-on-surface mt-4">Aucun article trouvé</h3>
                    <p class="text-on-surface-variant">Essayez de modifier vos filtres</p>
                `;
                grid.appendChild(msg);
            }
        } else {
            if (emptyMessage) {
                emptyMessage.remove();
            }
        }
    }

    // Filtrer automatiquement au changement
    document.getElementById('country-select')?.addEventListener('change', applyFilters);
    document.getElementById('city-select')?.addEventListener('change', applyFilters);

    // Filtrer au chargement
    document.addEventListener('DOMContentLoaded', applyFilters);
</script>
</body>
</html><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/community/index.blade.php ENDPATH**/ ?>