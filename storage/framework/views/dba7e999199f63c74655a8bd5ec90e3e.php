
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Communauté NEARSEO</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-variant": "#d1e4fb",
                        "on-tertiary": "#ffffff",
                        "background": "#f7f9ff",
                        "on-primary-fixed-variant": "#71361c",
                        "secondary-container": "#c9ecc9",
                        "on-surface-variant": "#53433d",
                        "on-secondary-container": "#4d6c50",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "primary": "#8c4a2f",
                        "surface-dim": "#c9dcf3",
                        "surface-container-highest": "#d1e4fb",
                        "primary-fixed": "#ffdbce",
                        "surface-container-low": "#edf4ff",
                        "on-primary-fixed": "#370e00",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "on-secondary-fixed": "#03210c",
                        "surface-container-high": "#d9eaff",
                        "on-tertiary-fixed": "#2e1500",
                        "on-secondary-fixed-variant": "#304d34",
                        "on-tertiary-container": "#fffbff",
                        "surface-tint": "#8e4c31",
                        "outline": "#86736c",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "inverse-surface": "#203243",
                        "tertiary-fixed-dim": "#ffb77c",
                        "surface-bright": "#f7f9ff",
                        "secondary": "#47664b",
                        "secondary-fixed": "#c9ecc9",
                        "on-secondary": "#ffffff",
                        "surface-container": "#e3efff",
                        "on-background": "#091d2e",
                        "inverse-on-surface": "#e8f2ff",
                        "tertiary-container": "#b06000",
                        "on-primary": "#ffffff",
                        "tertiary": "#8c4b00",
                        "tertiary-fixed": "#ffdcc2",
                        "surface-container-lowest": "#ffffff",
                        "surface": "#f7f9ff",
                        "on-surface": "#091d2e",
                        "primary-fixed-dim": "#ffb599",
                        "on-primary-container": "#fffbff",
                        "secondary-fixed-dim": "#adcfae",
                        "primary-container": "#a96245",
                        "outline-variant": "#d9c2ba",
                        "inverse-primary": "#ffb599"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "stack-gap-sm": "8px",
                        "stack-gap-md": "16px",
                        "section-margin": "32px",
                        "gutter": "16px",
                        "card-padding": "24px",
                        "container-max-width": "1280px"
                    },
                    fontFamily: {
                        "h1": ["Inter"],
                        "body": ["Inter"],
                        "h3": ["Inter"],
                        "body-sm": ["Inter"],
                        "h1-mobile": ["Inter"],
                        "label": ["Inter"],
                        "h2": ["Inter"]
                    },
                    fontSize: {
                        "h1": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "h3": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "h1-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "label": ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "h2": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f7f9ff;
            color: #091d2e;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .ai-indicator {
            border-left: 4px solid #47664b;
            background-color: #f0f4f0;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }
        .filter-btn-active {
            background-color: #8c4a2f;
            color: white;
        }
        .filter-btn-inactive {
            background-color: white;
            border: 1px solid #d9c2ba;
            color: #091d2e;
        }
    </style>
</head>
<body class="bg-background text-on-surface">

<!-- Main Content -->
<main class="max-w-[1280px] mx-auto px-4 py-8">

    <!-- Header Section -->
    <section class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-on-background mb-2">🌍 Communauté NEARSEO</h1>
        <p class="text-base text-on-surface-variant">Découvrez les dernières tendances du SEO local et les stratégies de demain partagées par nos experts.</p>
    </section>

    <!-- Filters Section -->
    <section class="mb-8 space-y-4">

        <!-- Filtre Pays -->
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-on-surface-variant mb-2">Pays</h3>
            <div class="flex flex-wrap gap-2">
                <button onclick="filterBy('country', '')" 
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all <?php echo e(request('country') ? 'border border-outline-variant bg-white text-on-surface hover:bg-surface-container' : 'bg-primary text-white'); ?>">
                    🌍 Tous
                </button>
                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button onclick="filterBy('country', '<?php echo e($country->geo_pays); ?>')" 
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all <?php echo e(request('country') == $country->geo_pays ? 'bg-primary text-white' : 'border border-outline-variant bg-white text-on-surface hover:bg-surface-container'); ?>">
                    <?php echo e($country->geo_pays); ?>

                    <span class="ml-1 text-xs opacity-60"><?php echo e($country->total); ?></span>
                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Filtre Ville -->
        <div>
            <h3 class="text-xs font-semibold uppercase tracking-wider text-on-surface-variant mb-2">Villes</h3>
            <div class="flex flex-wrap gap-2">
                <button onclick="filterBy('city', '')" 
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all <?php echo e(request('city') ? 'border border-outline-variant bg-white text-on-surface hover:bg-surface-container' : 'bg-primary text-white'); ?>">
                    📍 Toutes
                </button>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button onclick="filterBy('city', '<?php echo e($city->city); ?>')" 
                        class="px-4 py-2 rounded-full text-sm font-semibold transition-all <?php echo e(request('city') == $city->city ? 'bg-primary text-white' : 'border border-outline-variant bg-white text-on-surface hover:bg-surface-container'); ?>">
                    <?php echo e($city->city); ?>

                    <span class="ml-1 text-xs opacity-60"><?php echo e($city->total); ?></span>
                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm card-hover <?php echo e($article->ai_generated ? 'ai-indicator' : ''); ?>">
            <div class="relative h-48">
                <?php if($article->image): ?>
                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>">
                <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-5xl text-primary/40">article</span>
                </div>
                <?php endif; ?>
                
                <div class="absolute top-4 left-4 bg-background/90 backdrop-blur-sm px-3 py-1 rounded-full border border-outline-variant">
                    <span class="text-xs font-semibold uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                        <?php echo e($article->city ?? $article->address ?? 'Non localisé'); ?>

                    </span>
                </div>
                
                <?php if($article->ai_generated): ?>
                <div class="absolute top-4 right-4 bg-secondary-container/95 border-l-4 border-secondary px-3 py-1 rounded-sm">
                    <span class="text-xs font-semibold uppercase tracking-wider text-on-secondary-container flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">psychology</span>
                        AI ANALYSIS
                    </span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="p-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs font-semibold uppercase tracking-wider text-on-surface-variant"><?php echo e($article->created_at->format('d M Y')); ?></span>
                    <?php if($article->seo_score >= 80): ?>
                    <div class="flex items-center gap-1 text-secondary font-bold">
                        <span class="material-symbols-outlined text-[16px]">trending_up</span>
                        <span class="text-xs font-semibold uppercase tracking-wider">BOOST AI <?php echo e($article->seo_score); ?>%</span>
                    </div>
                    <?php else: ?>
                    <div class="flex items-center gap-1 text-on-surface-variant font-bold opacity-60">
                        <span class="material-symbols-outlined text-[16px]">trending_flat</span>
                        <span class="text-xs font-semibold uppercase tracking-wider">BOOST AI <?php echo e($article->seo_score ?? 0); ?>%</span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <h2 class="text-lg font-semibold text-on-surface mb-3 line-clamp-2">
                    <a href="<?php echo e(route('blog.user.article', ['slug' => $article->user->slug ?? 'admin', 'articleSlug' => $article->slug])); ?>" class="hover:text-primary transition-colors">
                        <?php echo e($article->title); ?>

                    </a>
                </h2>
                
                <p class="text-sm text-on-surface-variant mb-6 line-clamp-3">
                    <?php echo e(Str::limit(strip_tags($article->content), 120)); ?>

                </p>
                
                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-surface-container overflow-hidden flex items-center justify-center">
                            <span class="text-primary text-xs font-bold"><?php echo e(strtoupper(substr($article->user->name ?? 'U', 0, 1))); ?></span>
                        </div>
                        <span class="text-xs font-semibold uppercase tracking-wider"><?php echo e($article->user->name ?? 'Anonyme'); ?></span>
                    </div>
                    <a href="<?php echo e(route('blog.user.article', ['slug' => $article->user->slug ?? 'admin', 'articleSlug' => $article->slug])); ?>" class="text-xs font-semibold uppercase tracking-wider text-primary font-bold flex items-center gap-1 hover:gap-2 transition-all">
                        Lire <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 text-center py-16 bg-surface-container-lowest rounded-xl border border-outline-variant">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant/40 mb-3">forum</span>
            <h3 class="text-lg font-semibold text-on-surface mb-2">Aucun article trouvé</h3>
            <p class="text-on-surface-variant">Aucun article ne correspond à vos filtres.</p>
            <a href="<?php echo e(route('community')); ?>" class="inline-block mt-4 text-primary hover:underline">Voir tous les articles</a>
        </div>
        <?php endif; ?>
    </section>

    <!-- Pagination -->
    <nav class="flex justify-center items-center gap-4 py-12">
        <?php echo e($articles->appends(request()->query())->links()); ?>

    </nav>

    <!-- Community CTA Section -->
    <section class="mt-8 bg-inverse-surface text-white rounded-xl p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 blur-[64px] rounded-full"></div>
        <div class="relative z-10 lg:flex lg:items-center lg:justify-between lg:gap-12">
            <div class="lg:max-w-xl">
                <h2 class="text-2xl font-semibold text-white mb-2">Rejoignez l'élite du SEO Local</h2>
                <p class="text-sm text-white/80 mb-6">Partagez votre expertise, gagnez en visibilité et accédez à nos outils d'analyse prédictive exclusifs.</p>
            </div>
            <div class="flex flex-col gap-3 lg:flex-row lg:w-auto lg:flex-shrink-0">
                <a href="<?php echo e(route('ai.create')); ?>" class="w-full py-4 bg-primary text-white font-semibold text-lg rounded-xl shadow-lg transition-transform active:scale-[0.98] lg:px-8 lg:w-max text-center">
                    Devenir contributeur
                </a>
                <button class="w-full py-4 bg-transparent border border-white/30 text-white font-semibold text-lg rounded-xl transition-colors hover:bg-white/10 lg:px-8 lg:w-max">
                    En savoir plus
                </button>
            </div>
        </div>
    </section>
</main>

<!-- Bottom Navigation -->
<nav class="fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-4 py-2 bg-surface border-t border-outline-variant h-16 lg:hidden">
    <div class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-full px-4 py-1 scale-95 transition-transform">
        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">rss_feed</span>
        <span class="text-[10px] font-semibold uppercase tracking-wider mt-0.5">Feed</span>
    </div>
    <div class="flex flex-col items-center justify-center text-on-surface-variant scale-95 transition-transform">
        <span class="material-symbols-outlined">search</span>
        <span class="text-[10px] font-semibold uppercase tracking-wider mt-0.5">Search</span>
    </div>
    <div class="flex flex-col items-center justify-center text-on-surface-variant scale-95 transition-transform">
        <span class="material-symbols-outlined">handyman</span>
        <span class="text-[10px] font-semibold uppercase tracking-wider mt-0.5">Tools</span>
    </div>
    <div class="flex flex-col items-center justify-center text-on-surface-variant scale-95 transition-transform">
        <span class="material-symbols-outlined">account_circle</span>
        <span class="text-[10px] font-semibold uppercase tracking-wider mt-0.5">Profile</span>
    </div>
</nav>

<script>
    // Filtrer par pays ou ville
    function filterBy(type, value) {
        const url = new URL(window.location.href);
        if (value) {
            url.searchParams.set(type, value);
        } else {
            url.searchParams.delete(type);
        }
        window.location.href = url.toString();
    }

    // Micro-interactions for cards
    document.querySelectorAll('article').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-4');
            }
        });
    }, observerOptions);

    document.querySelectorAll('article').forEach(card => {
        card.classList.add('transition-all', 'duration-500', 'opacity-0', 'translate-y-4');
        observer.observe(card);
    });
</script>

</body>
</html><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/community.blade.php ENDPATH**/ ?>