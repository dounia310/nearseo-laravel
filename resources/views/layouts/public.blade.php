{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="@yield('description', 'NEARSEO - Votre agent SEO local au Maroc')"/>
    <title>@yield('title', 'NEARSEO')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    @stack('styles')
    
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
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="font-body text-body">

    <!-- HEADER PUBLIC -->
    <x-public-header :active="$active ?? null" />

    <!-- CONTENT -->
    <main class="pt-24">
        @yield('content')
    </main>

    <!-- FOOTER PUBLIC -->
    <x-public-footer />

    @stack('scripts')
</body>
</html>