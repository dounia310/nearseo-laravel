{{-- resources/views/blog/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog SEO Maroc | NEARSEO - Référencement local et contenu IA</title>
    <meta name="description" content="Découvrez le blog NEARSEO : conseils SEO local au Maroc, articles optimisés Google, stratégie de contenu et visibilité pour commerçants à Marrakech, Casablanca et partout au Maroc.">
    <meta name="keywords" content="SEO Maroc, référencement local Maroc, blog SEO, contenu IA, visibilité Google, Marrakech, Casablanca, NEARSEO">
    <meta name="author" content="NEARSEO">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Blog SEO Maroc | NEARSEO">
    <meta property="og:description" content="Conseils SEO local, contenu optimisé Google et stratégies de visibilité pour commerçants marocains.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="NEARSEO">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Blog SEO Maroc | NEARSEO">
    <meta name="twitter:description" content="Conseils SEO local, contenu optimisé Google et stratégies de visibilité pour commerçants marocains.">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        background: "#f8fafc",
                        surface: "#ffffff",
                        "surface-soft": "#f1f5f9",
                        primary: "#8c4a2f",
                        "primary-strong": "#6f381f",
                        accent: "#2563eb",
                        text: "#0f172a",
                        muted: "#475569",
                        border: "#e2e8f0",
                        success: "#16a34a"
                    },
                    boxShadow: {
                        soft: "0 10px 30px rgba(15, 23, 42, 0.08)",
                        glow: "0 20px 60px rgba(140, 74, 47, 0.15)"
                    },
                    borderRadius: {
                        xl: "1rem",
                        "2xl": "1.25rem",
                        "3xl": "1.75rem"
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .hero-bg {
            background:
                radial-gradient(circle at top left, rgba(140, 74, 47, 0.12), transparent 35%),
                radial-gradient(circle at top right, rgba(37, 99, 235, 0.10), transparent 30%),
                linear-gradient(180deg, #fff 0%, #f8fafc 100%);
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-background text-text font-[Inter] selection:bg-primary selection:text-white">

<header class="sticky top-0 z-50 backdrop-blur bg-white/80 border-b border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="NEARSEO" class="w-9 h-9 object-contain">
                <div class="leading-tight">
                    <p class="font-extrabold text-text">NEARSEO</p>
                    <p class="text-xs text-muted">Votre agent SEO local au Maroc</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-6 text-sm text-muted">
                <a href="#articles" class="hover:text-primary transition-colors">Articles</a>
                <a href="#features" class="hover:text-primary transition-colors">Fonctionnalités</a>
                <a href="#pricing" class="hover:text-primary transition-colors">Tarifs</a>
                <a href="{{ route('login') }}" class="hover:text-primary transition-colors">Connexion</a>
            </nav>

            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary text-white font-semibold shadow-soft hover:bg-primary-strong transition-colors">
                Essai gratuit
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>
</header>

<main>
    <section class="hero-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-border shadow-sm text-sm text-muted mb-6">
                        <span class="material-symbols-outlined text-[18px] text-success">auto_awesome</span>
                        <span>Plus de 1000 commerçants nous font confiance</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                        Blog SEO Maroc pour attirer plus de clients localement
                    </h1>

                    <p class="mt-6 text-lg text-muted max-w-2xl leading-8">
                        Découvrez des conseils concrets sur le référencement local, la rédaction optimisée et la visibilité Google pour développer votre commerce à Marrakech, Casablanca et partout au Maroc.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-primary text-white font-semibold shadow-glow hover:bg-primary-strong transition-colors">
                            Commencer gratuitement
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                        <a href="#articles" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-white border border-border font-semibold text-text hover:border-primary hover:text-primary transition-colors">
                            Voir les articles
                        </a>
                    </div>

                    <div class="mt-10 grid sm:grid-cols-3 gap-4 max-w-2xl">
                        <div class="bg-white rounded-2xl border border-border p-4 shadow-sm">
                            <p class="text-2xl font-bold text-primary">98/100</p>
                            <p class="text-sm text-muted mt-1">Pertinence locale</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-border p-4 shadow-sm">
                            <p class="text-2xl font-bold text-primary">3 min</p>
                            <p class="text-sm text-muted mt-1">Pour générer un article</p>
                        </div>
                        <div class="bg-white rounded-2xl border border-border p-4 shadow-sm">
                            <p class="text-2xl font-bold text-primary">1000+</p>
                            <p class="text-sm text-muted mt-1">Commerçants accompagnés</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white rounded-3xl shadow-soft border border-border overflow-hidden">
                        <div class="p-6 border-b border-border">
                            <p class="text-sm font-semibold text-primary">Agent NEARSEO actif</p>
                            <h2 class="mt-2 text-2xl font-bold">Les meilleurs boulangers de Bordeaux</h2>
                            <p class="mt-2 text-sm text-muted">Exemple d’article optimisé pour Google, prêt à publier.</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary mt-0.5">neurology</span>
                                <div>
                                    <p class="font-semibold">Génération d’articles</p>
                                    <p class="text-sm text-muted">Contenu structuré, engageant et optimisé SEO.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary mt-0.5">analytics</span>
                                <div>
                                    <p class="font-semibold">SEO en temps réel</p>
                                    <p class="text-sm text-muted">Analyse instantanée des mots-clés locaux.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary mt-0.5">location_on</span>
                                <div>
                                    <p class="font-semibold">Géolocalisation</p>
                                    <p class="text-sm text-muted">Ciblez votre ville, quartier ou région.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl p-6 border border-border shadow-sm">
                    <span class="material-symbols-outlined text-3xl text-primary">neurology</span>
                    <h3 class="mt-4 text-xl font-bold">Génération d’articles</h3>
                    <p class="mt-3 text-muted leading-7">Créez du contenu clair, structuré et orienté conversion en quelques secondes.</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-border shadow-sm">
                    <span class="material-symbols-outlined text-3xl text-primary">analytics</span>
                    <h3 class="mt-4 text-xl font-bold">SEO en temps réel</h3>
                    <p class="mt-3 text-muted leading-7">Mesurez la qualité SEO de vos contenus avant publication.</p>
                </div>
                <div class="bg-white rounded-3xl p-6 border border-border shadow-sm">
                    <span class="material-symbols-outlined text-3xl text-primary">location_on</span>
                    <h3 class="mt-4 text-xl font-bold">Ciblage local</h3>
                    <p class="mt-3 text-muted leading-7">Optimisez vos contenus pour une zone géographique précise.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="articles" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8">
                <div>
                    <p class="text-sm font-semibold text-primary uppercase tracking-[0.2em]">Blog</p>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold">Articles récents</h2>
                    <p class="mt-3 text-muted max-w-2xl">Stratégies, guides et bonnes pratiques pour améliorer votre présence locale sur Google.</p>
                </div>

                <div class="relative w-full lg:w-[360px]">
                    <input id="searchInput" type="text" placeholder="Rechercher un article..." class="w-full pl-12 pr-4 py-3 rounded-2xl border border-border bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-muted">search</span>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8">
                <div class="lg:col-span-8 space-y-6">
                    @forelse($articles as $article)
                        <article class="article-card bg-white rounded-3xl border border-border shadow-sm hover:shadow-soft transition-all overflow-hidden">
                            <div class="grid md:grid-cols-3">
                                <div class="md:col-span-1 h-56 md:h-full bg-surface-soft overflow-hidden">
                                    @if($article->image)
                                        <img class="article-image w-full h-full object-cover transition-transform duration-500" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-accent/10">
                                            <span class="material-symbols-outlined text-5xl text-primary/40">article</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="md:col-span-2 p-6">
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-muted">
                                        <span class="inline-flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                            {{ $article->created_at->format('d F Y') }}
                                        </span>
                                        @if($article->focus_keyword)
                                            <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">
                                                {{ $article->focus_keyword }}
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            {{ number_format($article->views ?? 0) }} vues
                                        </span>
                                    </div>

                                    <h3 class="mt-4 text-2xl font-bold leading-snug hover:text-primary transition-colors">
                                        <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h3>

                                    <p class="mt-4 text-muted leading-7 line-clamp-3">
                                        {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 180) }}
                                    </p>

                                    <div class="mt-6 flex items-center justify-between gap-4">
                                        <a href="{{ route('blog.show', $article->slug) }}" class="inline-flex items-center gap-2 font-semibold text-primary hover:text-primary-strong transition-colors">
                                            Lire la suite
                                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="bg-white rounded-3xl border border-border p-10 text-center shadow-sm">
                            <span class="material-symbols-outlined text-5xl text-muted">feed</span>
                            <h3 class="mt-4 text-xl font-bold">Aucun article publié</h3>
                            <p class="mt-2 text-muted">Commencez à rédiger votre premier article pour alimenter votre blog.</p>
                        </div>
                    @endforelse

                    @if($articles->hasPages())
                        <div class="pt-4">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </div>

                <aside class="lg:col-span-4 space-y-6">
                    <section class="bg-white rounded-3xl border border-border p-6 shadow-sm">
                        <h3 class="text-xl font-bold">À propos</h3>
                        <div class="mt-5 text-center">
                            <div class="w-20 h-20 mx-auto rounded-full bg-primary/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-primary">person</span>
                            </div>
                            <p class="mt-4 font-bold text-lg">{{ $user->name ?? 'Auteur' }}</p>
                            <p class="mt-2 text-muted leading-7">Passionné par le référencement local, la création de contenu et la visibilité des commerces marocains.</p>
                            <a href="{{ route('profile.edit') }}" class="mt-5 inline-flex w-full items-center justify-center px-4 py-3 rounded-2xl border border-primary text-primary font-semibold hover:bg-primary hover:text-white transition-colors">
                                Voir le profil
                            </a>
                        </div>
                    </section>

                    @if($recentArticles->count() > 0)
                        <section class="bg-white rounded-3xl border border-border p-6 shadow-sm">
                            <h3 class="text-xl font-bold">Articles récents</h3>
                            <ul class="mt-5 space-y-4">
                                @foreach($recentArticles as $recent)
                                    <li>
                                        <p class="text-xs uppercase tracking-[0.2em] text-primary font-semibold">{{ $recent->created_at->format('d.m.Y') }}</p>
                                        <a href="{{ route('blog.show', $recent->slug) }}" class="mt-1 block font-semibold text-text hover:text-primary transition-colors">
                                            {{ $recent->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    @if($archives->count() > 0)
                        <section class="bg-white rounded-3xl border border-border p-6 shadow-sm">
                            <h3 class="text-xl font-bold">Archives</h3>
                            <ul class="mt-5 space-y-3">
                                @foreach($archives as $archive)
                                    <li class="flex items-center justify-between text-sm text-muted">
                                        <span>{{ DateTime::createFromFormat('!m', $archive->month)->format('F') }} {{ $archive->year }}</span>
                                        <span class="px-2 py-1 rounded-full bg-surface-soft text-text">{{ $archive->count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    @if($allTags->count() > 0)
                        <section class="bg-white rounded-3xl border border-border p-6 shadow-sm">
                            <h3 class="text-xl font-bold">Libellés</h3>
                            <div class="mt-5 flex flex-wrap gap-2">
                                @foreach($allTags as $tag => $count)
                                    <span class="px-3 py-1 rounded-full bg-surface-soft text-sm text-muted hover:bg-primary hover:text-white transition-colors cursor-pointer">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <section class="bg-primary rounded-3xl p-6 text-white shadow-glow">
                        <h3 class="text-xl font-bold">Rejoindre la communauté</h3>
                        <p class="mt-3 text-white/90 leading-7">Recevez les dernières stratégies SEO local et les nouveautés de NEARSEO.</p>
                        <form class="mt-5 space-y-3">
                            <input type="email" placeholder="votre@email.com" class="w-full px-4 py-3 rounded-2xl text-text outline-none border border-transparent focus:border-white">
                            <button type="button" class="w-full px-4 py-3 rounded-2xl bg-white text-primary font-semibold hover:bg-surface-soft transition-colors">
                                S’inscrire
                            </button>
                        </form>
                    </section>
                </aside>
            </div>
        </div>
    </section>

    <section id="pricing" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-sm font-semibold text-primary uppercase tracking-[0.2em]">Tarifs</p>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold">Des plans simples et transparents</h2>
                <p class="mt-3 text-muted">Choisissez le plan adapté à votre rythme de publication et à votre stratégie locale.</p>
            </div>

            <div class="mt-10 grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-3xl border border-border p-6 shadow-sm">
                    <h3 class="text-xl font-bold">Gratuit</h3>
                    <p class="mt-3 text-4xl font-extrabold">0€<span class="text-base font-medium text-muted">/mois</span></p>
                    <ul class="mt-6 space-y-3 text-muted">
                        <li>2 articles par mois</li>
                        <li>Optimisation locale basique</li>
                        <li>Support standard</li>
                    </ul>
                </div>

                <div class="bg-white rounded-3xl border-2 border-primary p-6 shadow-soft relative">
                    <span class="absolute -top-3 left-6 px-3 py-1 rounded-full bg-primary text-white text-xs font-semibold">Populaire</span>
                    <h3 class="text-xl font-bold">Pro</h3>
                    <p class="mt-3 text-4xl font-extrabold">250 DH<span class="text-base font-medium text-muted">/mois</span></p>
                    <ul class="mt-6 space-y-3 text-muted">
                        <li>15 articles par mois</li>
                        <li>Agent Premium</li>
                        <li>Analytics & rapport mensuel</li>
                        <li>Support prioritaire</li>
                    </ul>
                </div>

                <div class="bg-white rounded-3xl border border-border p-6 shadow-sm">
                    <h3 class="text-xl font-bold">Business</h3>
                    <p class="mt-3 text-4xl font-extrabold">1000 DH<span class="text-base font-medium text-muted">/an</span></p>
                    <ul class="mt-6 space-y-3 text-muted">
                        <li>Articles illimités</li>
                        <li>Gestion multi-sites</li>
                        <li>Accès API & intégrations</li>
                        <li>Account manager dédié</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-white border-t border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('logo.png') }}" alt="NEARSEO" class="w-9 h-9 object-contain">
                    <div>
                        <p class="font-extrabold">NEARSEO</p>
                        <p class="text-sm text-muted">SEO local au Maroc</p>
                    </div>
                </div>
                <p class="mt-4 text-sm text-muted leading-7">L’intelligence artificielle au service du référencement local et du contenu optimisé.</p>
            </div>

            <div>
                <h4 class="font-bold">Produit</h4>
                <ul class="mt-4 space-y-2 text-sm text-muted">
                    <li><a href="#features" class="hover:text-primary">Fonctionnalités</a></li>
                    <li><a href="#pricing" class="hover:text-primary">Tarifs</a></li>
                    <li><a href="#articles" class="hover:text-primary">Blog</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold">Ressources</h4>
                <ul class="mt-4 space-y-2 text-sm text-muted">
                    <li><a href="{{ url('/community') }}" class="hover:text-primary">Communauté</a></li>
                    <li><a href="#" class="hover:text-primary">Guides SEO</a></li>
                    <li><a href="#" class="hover:text-primary">Documentation</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold">Contact</h4>
                <ul class="mt-4 space-y-2 text-sm text-muted">
                    <li><a href="#" class="hover:text-primary">Support</a></li>
                    <li><a href="#" class="hover:text-primary">Partenaires</a></li>
                    <li><a href="#" class="hover:text-primary">Sales</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-border flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted">
            <p>© 2026 NEARSEO. Tous droits réservés.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-primary"><span class="material-symbols-outlined">language</span></a>
                <a href="#" class="hover:text-primary"><span class="material-symbols-outlined">share</span></a>
                <a href="#" class="hover:text-primary"><span class="material-symbols-outlined">policy</span></a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.querySelectorAll('.article-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const articles = document.querySelectorAll('.article-card');

            articles.forEach(article => {
                const title = article.querySelector('h3')?.innerText.toLowerCase() || '';
                const content = article.querySelector('.line-clamp-3')?.innerText.toLowerCase() || '';

                article.style.display = (title.includes(searchTerm) || content.includes(searchTerm)) ? '' : 'none';
            });
        });
    }
</script>
</body>
</html>