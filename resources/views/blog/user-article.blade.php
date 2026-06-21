<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $article->title }} | {{ $user->name }} - NEARSEO</title>
    
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
                        "tertiary-container": "#b06000",
                        "on-primary": "#ffffff",
                        "tertiary": "#8c4b00",
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
                        "primary-fixed-dim": "#ffb599",
                        "on-primary-container": "#fffbff",
                        "secondary-fixed-dim": "#adcfae",
                        "primary-container": "#a96245",
                        "outline-variant": "#d9c2ba",
                        "inverse-primary": "#ffb599",
                        "tertiary-fixed": "#ffdcc2",
                        "surface-container-lowest": "#ffffff",
                        "surface": "#f7f9ff",
                        "on-surface": "#091d2e",
                        "error-container": "#ffdad6",
                        "primary": "#8c4a2f",
                        "surface-dim": "#c9dcf3",
                        "surface-container-highest": "#d1e4fb",
                        "primary-fixed": "#ffdbce",
                        "surface-variant": "#d1e4fb",
                        "on-tertiary": "#ffffff",
                        "background": "#f7f9ff",
                        "on-primary-fixed-variant": "#71361c",
                        "secondary-container": "#c9ecc9",
                        "on-surface-variant": "#53433d",
                        "on-secondary-container": "#4d6c50",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#d9eaff",
                        "on-tertiary-fixed": "#2e1500",
                        "on-secondary-fixed-variant": "#304d34",
                        "on-tertiary-container": "#fffbff",
                        "surface-tint": "#8e4c31",
                        "outline": "#86736c",
                        "surface-container-low": "#edf4ff",
                        "on-primary-fixed": "#370e00",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "on-secondary-fixed": "#03210c"
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
                        "gutter": "16px",
                        "card-padding": "24px",
                        "section-margin": "32px",
                        "container-max-width": "1280px"
                    },
                    fontFamily: {
                        "label": ["Inter"],
                        "h2": ["Inter"],
                        "h1": ["Inter"],
                        "body": ["Inter"],
                        "h3": ["Inter"],
                        "body-sm": ["Inter"]
                    },
                    fontSize: {
                        "label": ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "h2": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "h1": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "h3": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}]
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
        .prose {
            max-width: none;
        }
        .prose h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #091d2e;
        }
        .prose h2 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: #091d2e;
        }
        .prose h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            color: #091d2e;
        }
        .prose p {
            margin-bottom: 1.25rem;
            color: #53433d;
            line-height: 1.8;
        }
        .prose ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .prose ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .prose li {
            margin-bottom: 0.5rem;
            color: #53433d;
        }
        .prose a {
            color: #8c4a2f;
            text-decoration: underline;
        }
        .prose a:hover {
            color: #6d3a25;
        }
        .prose img {
            border-radius: 0.5rem;
            max-width: 100%;
            height: auto;
            margin: 1.5rem 0;
        }
        .prose blockquote {
            border-left: 4px solid #8c4a2f;
            padding-left: 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
            color: #4b5563;
        }
        .prose .faq-item {
            background: #f3f4f6;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin: 1rem 0;
        }
        .prose .faq-item strong {
            display: block;
            margin-bottom: 0.5rem;
        }
        .prose .sommaire {
            background: #f3f4f6;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            border: 1px solid #e5e7eb;
        }
        .prose .sommaire ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .prose .sommaire li {
            padding: 0.25rem 0;
            margin-bottom: 0;
        }
        .prose .sommaire a {
            color: #8c4a2f;
            text-decoration: none;
        }
        .prose .sommaire a:hover {
            text-decoration: underline;
        }
        .prose .alert {
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin: 1rem 0;
        }
        .prose .alert-warning {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            color: #92400e;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-background font-body text-on-surface">

<!-- Main Content -->
<main class="max-w-4xl mx-auto px-4 py-12">

    <!-- Lien retour vers le blog -->
    <a href="{{ route('blog.index') }}" 
       class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium transition-colors mb-6">
        <span class="material-symbols-outlined">arrow_back</span>
        Retour au Blog
    </a>

    <!-- Hero Section / Header Article -->
    <header class="pb-8">
        <div class="text-center">
            @if($article->focus_keyword)
                <span class="inline-block px-3 py-1 bg-secondary-container text-on-secondary-container font-label text-label rounded-lg mb-4 uppercase tracking-widest">
                    {{ $article->focus_keyword }}
                </span>
            @endif
            
            <h1 class="font-h1 text-h1 text-on-surface mb-6 leading-tight">
                {{ $article->title }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-center gap-3 text-on-surface-variant font-body-sm text-body-sm">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">person</span>
                    <a href="{{ route('blog.user', $user->slug) }}" class="hover:text-primary transition-colors">
                        {{ $user->name }}
                    </a>
                </div>
                <span class="w-1 h-1 bg-outline rounded-full"></span>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                    <span>{{ $article->created_at->format('d F, Y') }}</span>
                </div>
                <span class="w-1 h-1 bg-outline rounded-full"></span>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">schedule</span>
                    <span>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min de lecture</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    @if($article->image)
        <section class="mb-8">
            <div class="aspect-[21/9] w-full rounded-xl overflow-hidden shadow-sm">
                <img class="w-full h-full object-cover" 
                     src="{{ asset('storage/' . $article->image) }}" 
                     alt="{{ $article->title }}"/>
            </div>
        </section>
    @endif

    <!-- Article Content WITH CLEANING -->
    <article class="prose max-w-none font-body text-body">
        @php
            $content = $article->content;
            
            // Nettoyage
            $content = trim($content);
            if (substr($content, 0, 1) === '"') $content = substr($content, 1);
            if (substr($content, -1) === '"') $content = substr($content, 0, -1);
            
            $content = stripslashes($content);
            $content = str_replace(['\\n', '\n', '\\r', '\r'], '', $content);
            $content = str_replace('\"', '"', $content);
            $content = str_replace("\'", "'", $content);
            
            // Restaurer les mots coupés
            $corrections = [
                'Introductio' => 'Introduction',
                'Conclusio' => 'Conclusion',
                'aiversaire' => 'anniversaire',
                'persoalisée' => 'personnalisée',
                'persoalisation' => 'personnalisation',
                'sélectioée' => 'sélectionnée',
                'sélectioons' => 'sélectionnons',
                'quotidiees' => 'quotidiennes',
                'exceptioelles' => 'exceptionnelles',
                'professioelles' => 'professionnelles',
                'professioels' => 'professionnels',
                'boutoière' => 'boutonnière',
                'aboements' => 'abonnements',
                'coaissances' => 'connaissances',
                'boe' => 'bonne',
                'aée' => 'année',
                'coaître' => 'connaître',
                'taeries' => 'tanneries',
                'traditioel' => 'traditionnel',
                'impressioantes' => 'impressionnantes',
                'passioant' => 'passionnant',
                'attentioé' => 'attentionné',
                'professioel' => 'professionnel',
                'persoes' => 'personnes',
                'coaissent' => 'connaissent',
                'façoées' => 'façonnées',
                'coaisseurs' => 'connaisseurs',
                'randoées' => 'randonnées',
                's\'adoer' => 's\'adonner',
                'n2' => '',
                'n3' => '',
                'n4' => '',
                'n5' => '',
            ];
            
            foreach ($corrections as $wrong => $correct) {
                $content = str_replace($wrong, $correct, $content);
            }
            
            // Corriger les apostrophes
            $content = str_replace("'est", "n'est", $content);
            $content = str_replace("'hésitez", "n'hésitez", $content);
            $content = str_replace("'a", "n'a", $content);
            $content = str_replace("'attendez", "n'attendez", $content);
            
            // Nettoyer les espaces
            $content = preg_replace('/\s+/', ' ', $content);
            $content = trim($content);
        @endphp

        {!! $content !!}
    </article>

    <!-- Article Footer -->
    <footer class="mt-12 pt-8 border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-4">
        <a href="{{ route('blog.index') }}" 
           class="flex items-center gap-2 text-primary hover:underline transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            <span class="font-label">Retour au Blog</span>
        </a>
        
        <div class="flex items-center gap-4">
            <span class="text-on-surface-variant font-label text-label">Partager :</span>
            <div class="flex gap-2">
                <button onclick="shareArticle()" 
                        class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg text-on-surface hover:bg-surface-variant transition-colors">
                    <span class="material-symbols-outlined text-[20px]">share</span>
                </button>
                <button onclick="copyLink()" 
                        class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg text-on-surface hover:bg-surface-variant transition-colors">
                    <span class="material-symbols-outlined text-[20px]">content_copy</span>
                </button>
            </div>
        </div>
    </footer>
</main>

<script>
    function shareArticle() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $article->title }}',
                text: 'Découvrez cet article de {{ $user->name }} sur NEARSEO',
                url: window.location.href
            }).catch(() => {});
        } else {
            copyLink();
        }
    }
    
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Lien copié dans le presse-papier !');
        }).catch(() => {
            prompt('Copiez ce lien :', window.location.href);
        });
    }
</script>

</body>
</html>