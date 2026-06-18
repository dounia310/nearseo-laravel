{{-- resources/views/layouts/blog.blade.php --}}
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wanderly')</title>
    
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
                }
            }
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
            font-weight: 700;
            font-size: 1.5rem;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #091d2e;
        }
        .prose h3 {
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
        .prose .faq-item {
            background: #f0f4f0;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            border: 1px solid #d9c2ba;
        }
        .prose .faq-item strong {
            display: block;
            margin-bottom: 0.5rem;
            color: #091d2e;
        }
        .prose .sommaire {
            background: #edf4ff;
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            border: 1px solid #d9c2ba;
        }
        .prose .sommaire h2 {
            margin-top: 0 !important;
            font-size: 1.2rem !important;
        }
        .prose .sommaire ul {
            list-style: none;
            padding-left: 0;
            margin: 0.5rem 0;
        }
        .prose .sommaire li {
            padding: 0.25rem 0;
        }
        .prose .sommaire a {
            color: #8c4a2f;
            text-decoration: none;
        }
        .prose .sommaire a:hover {
            text-decoration: underline;
        }
        .prose .keyword {
            color: #8c4a2f;
            font-weight: 600;
        }
        
        /* Animation d'entrée */
        .article-enter {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-body text-body">
    <!-- TopNavBar -->
    
    

    <main class="max-w-container-max-width mx-auto px-gutter mt-section-margin">
        @yield('content')
    </main>


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
    
    @stack('scripts')
</body>
</html>