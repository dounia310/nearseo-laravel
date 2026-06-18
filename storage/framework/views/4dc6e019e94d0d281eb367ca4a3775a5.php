<!DOCTYPE html>
<html class="light" lang="fr">
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

.dark {
    background-color: #1a1a2e;
    color: #fffff;
}

.dark .bg-white {
    background-color: #f3f5fa;
    border-color: #e6e9ed;
}

.dark .text-gray-500,
.dark .text-gray-600 {
    color: #fffff;
}
img[src*="logo"] {
        background: transparent;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
    
    /* Logo en version sombre pour dark mode */
    .dark img[src*="logo"] {
        filter: brightness(0) invert(1);


    /* Favicon circulaire avec fond blanc */
.link-favicon {
    border-radius: 50%;
    background-color: #fffff;
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
/* Pour que le footer reste toujours en bas */
aside {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

nav {
    overflow-y: auto;
    flex: 1;
    min-height: 0; /* مهم للـ flex pour le scroll */
}

.shrink-0 {
    flex-shrink: 0;
}
/* Mode sombre */
        .dark {
            color-scheme: dark;
        }
        
        .dark body {
            background-color: #1a1a2e;
            color: #e2e8f0;
        }
        
        .dark .bg-white {
            background-color: #1e293b !important;
        }
        
        .dark .bg-gray-50 {
            background-color: #0f172a !important;
        }
        
        .dark .bg-gray-100 {
            background-color: #1e293b !important;
        }
        
        .dark .border-gray-200 {
            border-color: #334155 !important;
        }
        
        .dark .text-gray-900 {
            color: #f1f5f9 !important;
        }
        
        .dark .text-gray-700 {
            color: #cbd5e1 !important;
        }
        
        .dark .text-gray-500 {
            color: #94a3b8 !important;
        }
        
        .dark .text-gray-400 {
            color: #64748b !important;
        }
        
        .dark .text-gray-300 {
            color: #94a3b8 !important;
        }
        
        .dark .text-gray-600 {
            color: #94a3b8 !important;
        }
        
        .dark .bg-gray-200 {
            background-color: #334155 !important;
        }
        
        .dark .bg-gray-300 {
            background-color: #475569 !important;
        }
        
        .dark .bg-gray-400 {
            background-color: #64748b !important;
        }
        
        .dark .bg-gray-600 {
            background-color: #475569 !important;
        }
        
        .dark .bg-gray-700 {
            background-color: #334155 !important;
        }
        
        .dark .bg-gray-800 {
            background-color: #1e293b !important;
        }
        
        .dark .bg-gray-900 {
            background-color: #0f172a !important;
        }
        
        .dark .border {
            border-color: #334155 !important;
        }
        
        .dark .border-b {
            border-bottom-color: #334155 !important;
        }
        
        .dark .border-t {
            border-top-color: #334155 !important;
        }
        
        .dark .border-l {
            border-left-color: #334155 !important;
        }
        
        .dark .border-r {
            border-right-color: #334155 !important;
        }
        
        .dark .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.5) !important;
        }
        
        .dark .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.5), 0 1px 2px -1px rgba(0, 0, 0, 0.5) !important;
        }
        
        .dark .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -2px rgba(0, 0, 0, 0.5) !important;
        }
        
        .dark .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -4px rgba(0, 0, 0, 0.5) !important;
        }
        
        .dark .shadow-xl {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 8px 10px -6px rgba(0, 0, 0, 0.5) !important;
        }
        
        .dark .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7) !important;
        }
        
        /* Inputs en mode sombre */
        .dark input, 
        .dark select, 
        .dark textarea {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #f1f5f9 !important;
        }
        
        .dark input:focus, 
        .dark select:focus, 
        .dark textarea:focus {
            border-color: #A24E29 !important;
            outline: none !important;
        }
        
        .dark input::placeholder, 
        .dark textarea::placeholder {
            color: #64748b !important;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
    <!-- Favicons - Multi-systèmes -->
    <!-- Standard -->
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
    <!-- Favicon SVG (transparent, scalable, parfait pour tous écrans) -->
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    
    <!-- Fallback PNG pour les navigateurs anciens -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
    
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
</body>
</html><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>