{{-- resources/views/blog/index.blade.php --}}
<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Blog NEARSEO</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container": "#e3efff",
                        "background": "#f7f9ff",
                        "surface-container-low": "#edf4ff",
                        "on-tertiary-fixed": "#2e1500",
                        "surface-container-high": "#d9eaff",
                        "secondary-fixed": "#c9ecc9",
                        "primary-fixed-dim": "#ffb599",
                        "on-primary-container": "#fffbff",
                        "surface-dim": "#c9dcf3",
                        "secondary": "#47664b",
                        "tertiary": "#8c4b00",
                        "surface-container-highest": "#d1e4fb",
                        "inverse-primary": "#ffb599",
                        "on-primary-fixed-variant": "#71361c",
                        "secondary-container": "#c9ecc9",
                        "primary-container": "#a96245",
                        "on-error-container": "#93000a",
                        "surface": "#f7f9ff",
                        "secondary-fixed-dim": "#adcfae",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "on-secondary": "#ffffff",
                        "error": "#ba1a1a",
                        "outline": "#86736c",
                        "on-primary-fixed": "#370e00",
                        "tertiary-fixed-dim": "#ffb77c",
                        "surface-bright": "#f7f9ff",
                        "on-secondary-fixed": "#03210c",
                        "primary-fixed": "#ffdbce",
                        "on-primary": "#ffffff",
                        "on-tertiary-container": "#fffbff",
                        "surface-tint": "#8e4c31",
                        "on-background": "#091d2e",
                        "on-secondary-container": "#4d6c50",
                        "on-secondary-fixed-variant": "#304d34",
                        "inverse-surface": "#203243",
                        "outline-variant": "#d9c2ba",
                        "tertiary-container": "#b06000",
                        "error-container": "#ffdad6",
                        "primary": "#8c4a2f",
                        "surface-container-lowest": "#ffffff",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#ffdcc2",
                        "on-surface": "#091d2e",
                        "surface-variant": "#d1e4fb",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#53433d",
                        "inverse-on-surface": "#e8f2ff"
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
                        "section-margin": "32px",
                        "card-padding": "24px",
                        "stack-gap-sm": "8px",
                        "gutter": "16px"
                    },
                    fontFamily: {
                        label: ["Inter"],
                        h3: ["Inter"],
                        "h1-mobile": ["Inter"],
                        body: ["Inter"],
                        "body-sm": ["Inter"],
                        h2: ["Inter"],
                        h1: ["Inter"]
                    },
                    fontSize: {
                        label: ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        h3: ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "h1-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        body: ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        h2: ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        h1: ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}]
                    }
                }
            },
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 32px;
        }
        .article-card:hover .article-image {
            transform: scale(1.02);
        }
        .article-image {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-fixed selection:text-primary">

    <main class="max-w-container-max-width mx-auto px-gutter py-section-margin">
        <div class="bento-grid">
            <!-- Main Content Area (70%) -->
            <div class="col-span-12 lg:col-span-8 flex flex-col gap-stack-gap-md">
                <!-- Blog Header -->
                <section class="mb-8 text-center lg:text-left">
                    <div class="flex flex-col items-center lg:flex-row lg:items-start gap-6 mb-6">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center border-2 border-primary-fixed">
                            <span class="material-symbols-outlined text-4xl text-primary">article</span>
                        </div>
                        <div>
                            <h1 class="font-h1 text-h1 text-on-surface mb-2">Blog NEARSEO</h1>
                            <p class="text-on-surface-variant text-body max-w-2xl">Articles, guides et conseils pour votre visibilité locale.</p>
                            <div class="flex flex-wrap gap-4 mt-3 text-sm text-on-surface-variant">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">article</span>
                                    {{ $articles->total() }} articles
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">people</span>
                                    {{ $articles->pluck('user_id')->unique()->count() }} auteurs
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Article List -->
                <div class="flex flex-col gap-8">
                    @forelse($articles as $article)
                    <article class="article-card flex flex-col md:flex-row gap-6 bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-all">
                        <div class="w-full md:w-1/3 h-48 rounded-lg overflow-hidden shrink-0">
                            @if($article->image)
                            <img class="article-image w-full h-full object-cover" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                            @else
                            <div class="article-image w-full h-full bg-gradient-to-br from-primary/10 to-secondary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-primary/40">article</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-between flex-grow">
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="text-body-sm text-on-surface-variant">{{ $article->created_at->format('d F, Y') }}</span>
                                    <span class="text-body-sm text-on-surface-variant">·</span>
                                    <span class="text-body-sm text-on-surface-variant">{{ $article->user->name ?? 'Anonyme' }}</span>
                                    @if($article->focus_keyword)
                                    <span class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-label font-label">{{ $article->focus_keyword }}</span>
                                    @endif
                                </div>
                                <h2 class="font-h2 text-h2 text-on-surface mb-2 font-bold cursor-pointer hover:text-primary transition-colors">
                                    <a href="{{ route('blog.user.article', ['slug' => $article->user->slug, 'articleSlug' => $article->slug]) }}">{{ $article->title }}</a>
                                </h2>
                                <p class="text-on-surface-variant text-body-sm line-clamp-3 mb-4">
                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 150) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-outline-variant">
                                <a href="{{ route('blog.user.article', ['slug' => $article->user->slug, 'articleSlug' => $article->slug]) }}" class="text-primary font-bold hover:underline flex items-center gap-2">
                                    Lire la suite <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                                <div class="flex gap-4 text-on-surface-variant text-body-sm">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">visibility</span> {{ number_format($article->views ?? 0) }}</span>
                                </div>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="text-center py-16 bg-surface-container-lowest rounded-xl border border-outline-variant">
                        <span class="material-symbols-outlined text-5xl text-on-surface-variant/40 mb-3">feed</span>
                        <h3 class="text-lg font-semibold text-on-surface mb-2">Aucun article publié</h3>
                        <p class="text-on-surface-variant">Aucun article n'a encore été publié sur le blog.</p>
                        @auth
                        <a href="{{ route('ai.create') }}" class="inline-block mt-4 bg-primary text-on-primary px-5 py-2 rounded-lg text-sm hover:bg-primary/90 transition">✏️ Créer mon premier article</a>
                        @endauth
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($articles->hasPages())
                <nav class="flex items-center justify-center gap-2 mt-8 py-4">
                    {{ $articles->links() }}
                </nav>
                @endif
            </div>

            <!-- Sidebar (30%) -->
            <aside class="col-span-12 lg:col-span-4 flex flex-col gap-8">
                <!-- Search Bar -->
                <div class="relative group">
                    <input id="searchInput" class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant bg-surface-container-lowest focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Rechercher un article..." type="text"/>
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary">search</span>
                </div>

                <!-- About Section -->
                <section class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant shadow-sm">
                    <h3 class="font-h3 text-h3 text-on-surface mb-6">À propos</h3>
                    <div class="flex flex-col items-center text-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-2 border-primary-fixed p-1 bg-primary/10 flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-primary">article</span>
                        </div>
                        <p class="font-bold text-on-surface mb-2 font-h2">NEARSEO Blog</p>
                        <p class="text-on-surface-variant text-body-sm mb-6 leading-relaxed">
                            Stratégies et conseils pour booster votre visibilité locale.
                        </p>
                        @auth
                        <a href="{{ route('ai.create') }}" class="w-full py-2 bg-primary text-on-primary rounded-lg font-bold hover:bg-primary/90 transition-all text-center">
                            ✏️ Écrire un article
                        </a>
                        @endauth
                    </div>
                </section>

                <!-- Recent Posts -->
                @if(isset($recentArticles) && $recentArticles->count() > 0)
                <section class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant shadow-sm">
                    <h3 class="font-h3 text-h3 text-on-surface mb-4">Articles récents</h3>
                    <ul class="flex flex-col gap-4">
                        @foreach($recentArticles as $recent)
                        <li class="group cursor-pointer">
                            <p class="text-label text-primary uppercase font-bold mb-1">{{ $recent->created_at->format('d.m.Y') }}</p>
                            <a href="{{ route('blog.user.article', ['slug' => $recent->user->slug, 'articleSlug' => $recent->slug]) }}" class="text-body font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2">{{ $recent->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </section>
                @endif

                <!-- Archives -->
                @if(isset($archives) && $archives->count() > 0)
                <section class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant shadow-sm">
                    <h3 class="font-h3 text-h3 text-on-surface mb-4">Archives</h3>
                    <ul class="flex flex-col gap-2">
                        @foreach($archives as $archive)
                        <li class="flex justify-between items-center text-body-sm text-on-surface-variant hover:text-primary cursor-pointer transition-colors">
                            <span>{{ DateTime::createFromFormat('!m', $archive->month)->format('F') }} {{ $archive->year }}</span>
                            <span class="text-label bg-surface-container px-2 py-0.5 rounded">{{ $archive->count }}</span>
                        </li>
                        @endforeach
                    </ul>
                </section>
                @endif

                <!-- Tag Cloud -->
                @if(isset($allTags) && $allTags->count() > 0)
                <section class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant shadow-sm">
                    <h3 class="font-h3 text-h3 text-on-surface mb-4">Libellés</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($allTags as $tag => $count)
                        <span class="px-3 py-1 bg-surface-container text-on-surface-variant rounded-full text-label hover:bg-primary-fixed transition-colors cursor-pointer">{{ $tag }}</span>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Newsletter -->
                <section class="bg-primary text-on-primary p-card-padding rounded-xl shadow-lg">
                    <h3 class="font-h3 text-h3 text-white mb-2">Abonnez-vous</h3>
                    <p class="text-on-primary text-body-sm mb-4 opacity-90">Recevez les derniers articles directement dans votre boîte mail.</p>
                    <div class="flex flex-col gap-3">
                        <input class="w-full px-4 py-2 rounded-lg text-on-surface text-body-sm outline-none" placeholder="votre@email.com" type="email"/>
                        <button class="w-full py-2 bg-white text-primary font-bold rounded-lg hover:bg-primary-fixed transition-all">S'inscrire</button>
                    </div>
                </section>
            </aside>
        </div>
    </main>

    <!-- Footer -->
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
                        <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#features">Fonctionnalités</a>
                        <a class="font-body-sm text-on-surface-variant hover:text-primary transition" href="#pricing">Tarifs</a>
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
        // Micro-interactions
        document.querySelectorAll('.article-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-4px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Search bar interaction
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                searchInput.parentElement.classList.add('scale-[1.02]');
            });
            searchInput.addEventListener('blur', () => {
                searchInput.parentElement.classList.remove('scale-[1.02]');
            });
            
            // Recherche en temps réel
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const articles = document.querySelectorAll('.article-card');
                
                articles.forEach(article => {
                    const title = article.querySelector('h2')?.innerText.toLowerCase() || '';
                    const content = article.querySelector('.line-clamp-3')?.innerText.toLowerCase() || '';
                    
                    if (title.includes(searchTerm) || content.includes(searchTerm)) {
                        article.style.display = '';
                    } else {
                        article.style.display = 'none';
                    }
                });
            });
        }
    </script>
</body>
</html>