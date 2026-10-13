<!DOCTYPE html>
<html class="<?php echo e(session('theme', 'light') === 'dark' ? 'dark' : 'light'); ?>" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NEARSEO - <?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-container": "#ffffff",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "inverse-surface": "#203243",
                        "secondary-container": "#c9ecc9",
                        "primary": "#8c4a2f",
                        "on-tertiary": "#ffffff",
                        "secondary": "#47664b",
                        "on-primary-fixed": "#370e00",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "tertiary-container": "#b06000",
                        "outline-variant": "#d9c2ba",
                        "surface-dim": "#c9dcf3",
                        "surface-container-high": "#d9eaff",
                        "on-secondary-container": "#4d6c50",
                        "on-tertiary-fixed": "#2e1500",
                        "tertiary": "#8c4b00",
                        "primary-container": "#a96245",
                        "primary-fixed": "#ffdbce",
                        "secondary-fixed-dim": "#adcfae",
                        "on-primary": "#ffffff",
                        "primary-fixed-dim": "#ffb599",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#d1e4fb",
                        "surface": "#ffffff",
                        "on-secondary-fixed-variant": "#304d34",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#ffb599",
                        "inverse-on-surface": "#ffffff",
                        "tertiary-fixed-dim": "#ffffff",
                        "surface-container-low": "#ffffff",
                        "surface-bright": "#ffffff",
                        "outline": "#86736c",
                        "error": "#ba1a1a",
                        "surface-tint": "#ffffff",
                        "on-secondary-fixed": "#03210c",
                        "tertiary-fixed": "#ffdcc2",
                        "on-primary-fixed-variant": "#71361c",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#fffbff",
                        "surface-variant": "#d1e4fb",
                        "on-background": "#091d2e",
                        "surface-container": "#e3efff",
                        "on-surface-variant": "#53433d",
                        "on-surface": "#091d2e",
                        "secondary-fixed": "#c9ecc9",
"background": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-gap-md": "16px",
                        "section-margin": "32px",
                        "gutter": "16px",
                        "card-padding": "24px",
                        "stack-gap-sm": "8px",
                        "container-max-width": "1280px"
                    },
                    "fontFamily": {
                        "h1-mobile": ["Inter"],
                        "label": ["Inter"],
                        "body": ["Inter"],
                        "h3": ["Inter"],
                        "h2": ["Inter"],
                        "h1": ["Inter"],
                        "body-sm": ["Inter"]
                    },
                    "fontSize": {
                        "h1-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "label": ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "h3": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "h2": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "h1": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        /* =============================================
           STYLES DE BASE (ORIGINAUX)
           ============================================= */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .filled-icon {
            font-variation-settings: 'FILL' 1;
        }
        .active-tab {
            border-bottom: 2px solid #8c4a2f;
            color: #8c4a2f !important;
        }

        img[src*="logo"] {
            background: transparent;
            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }

        .link-favicon {
            border-radius: 50%;
            background-color: #ffffff;
            padding: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .active-tab-indicator {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #8c4a2f;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        aside {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        nav {
            overflow-y: auto;
            flex: 1;
            min-height: 0;
        }

        .shrink-0 {
            flex-shrink: 0;
        }

        /* =============================================
           ✅ MODE CLAIR - ORIGINAL (NE PAS MODIFIER)
           ============================================= */
        /* Pas de styles spécifiques pour le mode clair car il est géré par défaut */

        /* =============================================
           ✅ MODE SOMBRE - Couleurs du dashboard
           ============================================= */
        html.dark {
            color-scheme: dark;
            background-color: #091d2e;
        }
        
        html.dark body {
            background-color: #091d2e;
            color: #ffffff;
        }
        
        /* Cartes et contenants */
        html.dark .bg-white,
        html.dark .bg-surface,
        html.dark .bg-surface-container-lowest,
        html.dark .bg-gray-50,
        html.dark .bg-gray-100 {
            background-color: #1a2b3c !important;
        }
        
        html.dark .bg-gray-200 {
            background-color: #2d3748 !important;
        }
        
        html.dark .bg-gray-300 {
            background-color: #3d4a5c !important;
        }
        
        html.dark .bg-gray-400 {
            background-color: #4a5a6e !important;
        }
        
        html.dark .bg-surface-container {
            background-color: #1e2f44 !important;
        }
        
        html.dark .bg-surface-container-high {
            background-color: #2d3e50 !important;
        }
        
        html.dark .bg-surface-container-low {
            background-color: #1a2b3c !important;
        }
        
        html.dark .bg-background {
            background-color: #091d2e !important;
        }
        
        /* Bordures */
        html.dark .border,
        html.dark .border-b,
        html.dark .border-t,
        html.dark .border-l,
        html.dark .border-r,
        html.dark .border-gray-200,
        html.dark .border-gray-300,
        html.dark .border-outline-variant {
            border-color: #2d3748 !important;
        }
        
        /* Texte */
        html.dark .text-gray-900,
        html.dark .text-gray-800,
        html.dark .text-gray-700,
        html.dark .text-on-surface {
            color: #ffffff !important;
        }
        
        html.dark .text-gray-600,
        html.dark .text-gray-500,
        html.dark .text-on-surface-variant {
            color: #cbd5e0 !important;
        }
        
        html.dark .text-gray-400,
        html.dark .text-gray-300 {
            color: #64748b !important;
        }
        
        /* Ombres */
        html.dark .shadow-sm,
        html.dark .shadow,
        html.dark .shadow-md,
        html.dark .shadow-lg,
        html.dark .shadow-xl,
        html.dark .shadow-2xl {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6) !important;
        }
        
        /* Inputs */
        html.dark input,
        html.dark select,
        html.dark textarea {
            background-color: #1a2b3c !important;
            border-color: #2d3748 !important;
            color: #ffffff !important;
        }
        
        html.dark input:focus,
        html.dark select:focus,
        html.dark textarea:focus {
            border-color: #c97c5d !important;
            outline: none !important;
        }
        
        html.dark input::placeholder,
        html.dark textarea::placeholder {
            color: #64748b !important;
        }
        
        /* Logo - Sans filtre en mode sombre */
        html.dark img[src*="logo"] {
            filter: none !important;
        }
        
        /* Prose */
        html.dark .prose {
            color: #e4e6eb !important;
        }
        
        html.dark .prose h1,
        html.dark .prose h2,
        html.dark .prose h3 {
            color: #f1f5f9 !important;
        }
        
        html.dark .prose p,
        html.dark .prose li {
            color: #cbd5e1 !important;
        }
        
        html.dark .prose a {
            color: #ffb599 !important;
        }
        
        /* Badges */
        html.dark .bg-secondary-container {
            background-color: #2d3e50 !important;
        }
        
        html.dark .bg-primary\/10 {
            background-color: rgba(201, 124, 93, 0.1) !important;
        }
        
        html.dark .bg-secondary\/20 {
            background-color: rgba(72, 187, 120, 0.2) !important;
        }
        
        html.dark .bg-primary\/20 {
            background-color: rgba(201, 124, 93, 0.2) !important;
        }
        
        html.dark .bg-error\/20 {
            background-color: rgba(252, 129, 129, 0.2) !important;
        }
        
        /* Sidebar en mode sombre */
        html.dark .dark\:bg-inverse-surface {
            background-color: #1a2b3c !important;
        }
        
        html.dark .dark\:bg-surface-container-lowest {
            background-color: #1a2b3c !important;
        }
        
        /* Scrollbar mode sombre */
        html.dark ::-webkit-scrollbar-track {
            background: #1a2b3c !important;
        }
        
        html.dark ::-webkit-scrollbar-thumb {
            background: #2d3748 !important;
            border-radius: 10px;
        }
        
        html.dark ::-webkit-scrollbar-thumb:hover {
            background: #c97c5d !important;
        }
        
        /* Notification */
        html.dark .bg-inverse-surface {
            background-color: #e2e8f0 !important;
        }
        
        html.dark .text-inverse-on-surface {
            color: #091d2e !important;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo e(asset('favicon-48x48.png')); ?>">
    <link rel="icon" type="image/png" sizes="64x64" href="<?php echo e(asset('favicon-64x64.png')); ?>">
    
    <!-- Apple iOS / iPadOS -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(asset('apple-touch-icon-57x57.png')); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo e(asset('apple-touch-icon-60x60.png')); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(asset('apple-touch-icon-72x72.png')); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(asset('apple-touch-icon-76x76.png')); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(asset('apple-touch-icon-114x114.png')); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset('apple-touch-icon-120x120.png')); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(asset('apple-touch-icon-144x144.png')); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(asset('apple-touch-icon-152x152.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon-180x180.png')); ?>">
    
    <!-- Android Chrome -->
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('android-chrome-192x192.png')); ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?php echo e(asset('android-chrome-512x512.png')); ?>">
    
    <!-- Windows / IE11 -->
    <meta name="msapplication-TileColor" content="#8c4a2f">
    <meta name="msapplication-TileImage" content="<?php echo e(asset('mstile-144x144.png')); ?>">
    <meta name="msapplication-config" content="<?php echo e(asset('browserconfig.xml')); ?>">
    
    <!-- Manifeste PWA -->
    <link rel="manifest" href="<?php echo e(asset('site.webmanifest')); ?>">
    
    <!-- Favicon SVG -->
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    
    <!-- Apple Touch Icon (iOS) -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon.png')); ?>">
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-fixed selection:text-on-primary-fixed">

<!-- Sidebar -->
<?php echo $__env->make('components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Main Wrapper -->
<div class="md:ml-64 min-h-screen flex flex-col">
    <!-- Topbar -->
    <?php echo $__env->make('components.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Page Content -->
    <main class="flex-1 p-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>

<script>
    // ✅ Gestion du thème
    document.addEventListener('DOMContentLoaded', function() {
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('theme') || 'light';
        
        if (savedTheme === 'dark') {
            html.classList.add('dark');
            html.classList.remove('light');
        } else {
            html.classList.remove('dark');
            html.classList.add('light');
        }
        
        html.className = savedTheme;
    });
</script>

</body>
</html><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>