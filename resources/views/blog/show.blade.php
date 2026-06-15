{{-- resources/views/blog/show.blade.php --}}
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $article->title }} | Wanderly</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                },
            },
        }
    </script>
    <style>
        body {
            background-color: #f7f9ff;
            color: #091d2e;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .prose blockquote {
            border-left: 4px solid #8c4a2f;
            padding-left: 1.5rem;
            font-style: italic;
            color: #53433d;
            margin: 2rem 0;
        }
        .prose h2 {
            font-family: 'Inter';
            font-weight: 700;
            font-size: 1.5rem;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #091d2e;
        }
        .prose h3 {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 1.25rem;
            margin-top: 1.75rem;
            margin-bottom: 0.75rem;
            color: #091d2e;
        }
        .prose p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }
        .prose ul, .prose ol {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .prose li {
            margin-bottom: 0.5rem;
        }
        .prose img {
            border-radius: 0.75rem;
            margin: 2rem 0;
        }
        .ai-framing {
            border-left: 4px solid #47664b;
            background-color: #f0f4f0;
            padding: 1rem;
            border-radius: 0 0.5rem 0.5rem 0;
        }
    </style>
</head>
<body class="font-body text-body">
    <!-- TopNavBar -->
    <header class="w-full top-0 sticky bg-surface z-50 border-b border-outline-variant">
        <div class="flex justify-between items-center px-gutter py-4 max-w-container-max-width mx-auto">
            <div class="font-h2 text-h2 text-primary tracking-tight">Wanderly</div>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Explore</a>
                <a class="text-primary font-bold border-b-2 border-primary" href="{{ route('blog') }}">Destinations</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">Lifestyle</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors" href="#">About</a>
            </nav>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-on-surface-variant cursor-pointer">search</span>
                <a href="{{ route('dashboard') }}" class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center bg-primary/10">
                    <span class="material-symbols-outlined text-primary">person</span>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-container-max-width mx-auto px-gutter mt-section-margin">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Main Content -->
            <article class="lg:w-[70%] bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
                <!-- Back Button -->
                <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:opacity-70 transition-opacity mb-8 group">
                    <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
                    <span class="font-label text-label">Retour au blog</span>
                </a>

                <!-- Hero Image -->
                @if($article->image)
                <div class="relative w-full aspect-[21/9] rounded-xl overflow-hidden mb-section-margin">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                </div>
                @endif

                <!-- Article Header -->
                <header class="mb-section-margin">
                    <h1 class="font-h1 text-h1 mb-4">{{ $article->title }}</h1>
                    <div class="flex items-center gap-4 text-on-surface-variant">
                        <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">person</span>
                        </div>
                        <div>
                            <p class="font-bold text-on-surface">{{ $article->user->name ?? 'Youssef Amrani' }}</p>
                            <p class="text-body-sm">{{ $article->created_at->format('d F Y') }} • {{ $article->read_time ?? 12 }} min de lecture</p>
                        </div>
                    </div>
                </header>

                <!-- Article Body -->
                <div class="prose max-w-none text-on-surface-variant font-body">
                    {!! $article->content !!}
                </div>

                <!-- Engagement Metrics -->
                <footer class="mt-section-margin pt-8 border-t border-outline-variant flex justify-between items-center">
                    <div class="flex gap-6">
                        <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">favorite</span>
                            <span class="font-label">{{ number_format($article->likes ?? 0) }}</span>
                        </button>
                        <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">visibility</span>
                            <span class="font-label">{{ number_format($article->views ?? 0) }}</span>
                        </button>
                    </div>
                    <div class="flex gap-4">
                        <button class="p-2 rounded-full border border-outline-variant hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined">share</span>
                        </button>
                        <button class="p-2 rounded-full border border-outline-variant hover:bg-surface-container transition-colors">
                            <span class="material-symbols-outlined">bookmark</span>
                        </button>
                    </div>
                </footer>
            </article>

            <!-- Sidebar -->
            <aside class="lg:w-[30%] flex flex-col gap-stack-gap-md">
                <!-- Search Bar -->
                <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
                    <div class="relative">
                        <input class="w-full bg-background border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg pl-10 py-3 text-body-sm" placeholder="Rechercher un article..." type="text"/>
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    </div>
                </div>

                <!-- Author Bio -->
                <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-24 h-24 rounded-full bg-primary/20 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-4xl text-primary">person</span>
                        </div>
                        <h3 class="font-h3 text-h3 text-on-surface mb-2">{{ $article->user->name ?? 'Youssef Amrani' }}</h3>
                        <p class="text-body-sm text-on-surface-variant mb-6 italic">Guide de montagne certifié et photographe passionné.</p>
                        <button class="w-full py-3 bg-primary text-on-primary rounded-lg font-bold hover:opacity-90 active:scale-95 transition-all">S'abonner</button>
                    </div>
                </div>

                <!-- Tags Populaires -->
                <div class="bg-surface-container-lowest p-card-padding rounded-xl shadow-sm border border-outline-variant">
                    <h3 class="font-h3 text-h3 text-on-surface mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">sell</span>
                        Tags populaires
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label font-bold cursor-pointer hover:bg-primary hover:text-white transition-colors">Randonnée</span>
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label font-bold cursor-pointer hover:bg-primary hover:text-white transition-colors">Maroc</span>
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label font-bold cursor-pointer hover:bg-primary hover:text-white transition-colors">Aventure</span>
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label font-bold cursor-pointer hover:bg-primary hover:text-white transition-colors">Atlas</span>
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label font-bold cursor-pointer hover:bg-primary hover:text-white transition-colors">Culture</span>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bg-secondary p-card-padding rounded-xl shadow-sm border border-secondary text-white">
                    <span class="material-symbols-outlined text-4xl mb-4">mail</span>
                    <h3 class="font-h3 text-h3 mb-2">Restez inspiré</h3>
                    <p class="text-body-sm opacity-90 mb-4">Recevez nos meilleurs récits de voyage directement dans votre boîte mail.</p>
                    <div class="space-y-2">
                        <input class="w-full bg-white/10 border-white/20 text-white placeholder:text-white/60 rounded-lg py-2 px-3 text-body-sm focus:ring-white" placeholder="Votre email" type="email"/>
                        <button class="w-full py-2 bg-white text-secondary font-bold rounded-lg hover:bg-opacity-90 transition-all">S'inscrire</button>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full mt-section-margin bg-surface-container-high border-t border-outline-variant">
        <div class="flex flex-col md:flex-row justify-between items-center px-gutter py-section-margin max-w-container-max-width mx-auto">
            <div class="mb-6 md:mb-0">
                <div class="font-h3 text-h3 text-primary mb-2">Wanderly</div>
                <p class="text-body-sm text-on-surface-variant">© {{ date('Y') }} Wanderly Travel & Lifestyle. All rights reserved.</p>
            </div>
            <nav class="flex gap-8">
                <a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Contact Us</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Privacy Policy</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Terms of Service</a>
                <a class="text-on-surface-variant hover:text-primary transition-colors text-body-sm" href="#">Press Kit</a>
            </nav>
        </div>
    </footer>

    <script>
        // Animation d'entrée
        document.addEventListener('DOMContentLoaded', () => {
            const article = document.querySelector('article');
            if (article) {
                article.style.opacity = '0';
                article.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    article.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                    article.style.opacity = '1';
                    article.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>