
<!DOCTYPE html>


<?php ($active = 'features'); ?>

<?php $__env->startSection('title', 'NEARSEO | Boostez votre SEO local avec l\'Intelligence Organique'); ?>

<?php $__env->startSection('content'); ?>
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NEARSEO | Boostez votre SEO local avec l'Intelligence Organique</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
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
    </style>
</head>
<body class="font-body text-body">




<main class="pt-16">
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-section-margin hero-gradient">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-12">
            <div class="flex-1 space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary/10 text-secondary rounded-full">
                <span class="material-symbols-outlined text-[18px]">location_on</span>
                <span class="font-label text-label">
                    VOTRE AGENT SEO LOCAL EST EN LIGNE
                </span>
            </div>
                <h1 class="font-h1 text-h1 md:text-[56px] leading-[1.1] text-on-background max-w-2xl">
                    Boostez votre <span class="text-primary">SEO local</span> avec l'Intelligence Organique.
                </h1>
                <p class="font-body text-body text-on-surface-variant max-w-xl">
                    NEARSEO combine l'expertise humaine locale avec la puissance de l'IA pour générer du contenu pertinent, optimisé pour Google Maps et vos clients de proximité.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="<?php echo e(route('register')); ?>" class="px-8 py-4 bg-primary text-on-primary rounded-xl font-h3 hover:shadow-lg transition-all active:scale-95">Commencer gratuitement</a>
                    <button class="px-8 py-4 border border-outline text-on-background rounded-xl font-h3 hover:bg-surface-container transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">play_circle</span>
                        Voir la démo
                    </button>
                </div>
            </div>
            <div class="flex-1 relative">
                <div class="rounded-2xl overflow-hidden shadow-2xl border border-outline-variant/20">
                    <img alt="Dashboard Preview" class="w-full aspect-video object-cover" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuDro1ly5aoaMAtsiaHptE5yDQRIYTEu7c9YRQQ3GWjnxW5FePL90usgXIFj9lRA4dmKj_L2qSAG8JpInIT8eGK1p0gtqlqfhWS8ai2mf-uC_PqjNaJ1Hv-qzt7njy9RxtFJ0z8RzRVW63qAuZR-pyTYdzIopYcG9DFXOSVHsnJqOyiA5jER4Vwr096UFn-7dRN8qxOnqH-BoyKC1gwK7B9F-MqBNHtWQ3A8X0xBBMD1a6QJxVl-bOJEqMqMHCZvHz_SEqh0EN6Wprlf"/>
                </div>
                <!-- Floating Badge -->
                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                    </div>
                    <div>
                        <p class="font-label text-label text-gray-500">CROISSANCE LOCALE</p>
                        <p class="font-h3 text-h3 text-secondary">+142%</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fonctionnalités Section -->
    <section id="features" class="py-section-margin bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 space-y-4">
                <h2 class="font-h1 text-h1 text-on-background">L'Intelligence Artificielle au service de votre quartier</h2>
                <p class="font-body text-body text-on-surface-variant max-w-2xl mx-auto">Tout ce dont vous avez besoin pour dominer les résultats de recherche locaux, sans passer des heures à rédiger.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group bg-white p-6 rounded-2xl border border-gray-100 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">edit_note</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-4 text-on-surface">Rédaction IA contextuelle</h3>
                    <p class="font-body text-body text-gray-500">Générez des articles de blog qui parlent réellement à votre communauté locale. Notre IA connaît vos spécificités régionales.</p>
                    <div class="mt-6 border-l-2 border-secondary/30 pl-4 bg-secondary/5 py-2">
                        <p class="text-sm italic text-secondary">"Article généré en 45 secondes pour une boulangerie à Marrakech."</p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="group bg-white p-6 rounded-2xl border border-gray-100 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">location_on</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-4 text-on-surface">Optimisation Maps</h3>
                    <p class="font-body text-body text-gray-500">Apparaissez en tête du "Local Pack". Nous optimisons vos fiches d'établissement pour une visibilité maximale sur Google Maps.</p>
                    <div class="mt-6 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                        <span class="font-label text-label text-secondary uppercase">Analyse temps réel</span>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="group bg-white p-6 rounded-2xl border border-gray-100 hover:shadow-xl transition-all">
                    <div class="w-14 h-14 bg-tertiary/10 rounded-xl flex items-center justify-center text-tertiary mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-[32px]">query_stats</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-4 text-on-surface">Reporting Organique</h3>
                    <p class="font-body text-body text-gray-500">Des tableaux de bord clairs qui mesurent vos visites réelles en magasin, pas seulement des clics abstraits.</p>
                    <div class="mt-6 space-y-2">
                        <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-tertiary w-[85%] rounded-full"></div>
                        </div>
                        <p class="font-label text-label text-gray-500">Objectif mensuel atteint</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-section-margin bg-surface">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-end justify-between mb-12 gap-6">
                <div class="max-w-xl">
                    <span class="text-primary font-label text-label uppercase tracking-widest mb-4 block">Succès partagés</span>
                    <h2 class="font-h1 text-h1 text-on-background">Ils font rayonner leur commerce local grâce à NEARSEO</h2>
                </div>
                <div class="flex gap-2">
                    <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-primary/5 transition-all">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center hover:bg-primary/5 transition-all">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 p-8 rounded-3xl flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-500 mb-6">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <p class="font-h3 text-h3 text-on-surface italic leading-relaxed mb-8">
                            "Grâce aux articles générés par NEARSEO, j'ai triplé mes demandes de devis locales en seulement 3 mois. L'IA comprend parfaitement les besoins de mes clients à Bordeaux."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 border-t border-gray-200 pt-6">
                        <div class="w-14 h-14 rounded-full overflow-hidden bg-primary/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl text-primary">person</span>
                        </div>
                        <div>
                            <p class="font-h3 text-body font-bold text-on-surface">Jean-Marc Dupuis</p>
                            <p class="text-sm text-gray-500">Gérant, Menuiserie Bordelaise</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-gray-50 p-8 rounded-3xl flex flex-col justify-between">
                    <div>
                        <div class="flex text-amber-500 mb-6">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <p class="font-h3 text-h3 text-on-surface italic leading-relaxed mb-8">
                            "L'interface est d'une simplicité déconcertante. En tant que fleuriste, je n'avais pas le temps pour le SEO. Maintenant, c'est mon assistant virtuel qui s'en charge."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 border-t border-gray-200 pt-6">
                        <div class="w-14 h-14 rounded-full overflow-hidden bg-secondary/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-2xl text-secondary">person</span>
                        </div>
                        <div>
                            <p class="font-h3 text-body font-bold text-on-surface">Sophie Laurent</p>
                            <p class="text-sm text-gray-500">Fondatrice, Atelier Floral Lyon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-section-margin">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-primary/5 p-12 md:p-24 rounded-[40px] text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-tertiary rounded-full translate-x-1/3 translate-y-1/3"></div>
                </div>
                <h2 class="font-h1 text-[40px] md:text-[48px] mb-8 relative z-10">Prêt à dominer votre marché local ?</h2>
                <p class="font-body text-h3 mb-12 max-w-2xl mx-auto relative z-10 text-gray-600">Rejoignez plus de 1 200 commerçants qui ont déjà automatisé leur croissance SEO.</p>
                <div class="flex flex-col md:flex-row justify-center gap-4 relative z-10">
                    <a href="<?php echo e(route('register')); ?>" class="px-10 py-5 bg-primary text-white font-h2 rounded-2xl hover:bg-primary/90 transition-all shadow-xl">Essai gratuit de 14 jours</a>
                    <button class="px-10 py-5 border-2 border-primary text-primary font-h2 rounded-2xl hover:bg-primary/5 transition-all">Parler à un expert</button>
                </div>
                <p class="mt-8 font-label text-label text-gray-500">Aucune carte de crédit requise • Annulation à tout moment</p>
            </div>
        </div>
    </section>
</main>


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

    // Button micro-interactions
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('mousedown', () => {
            button.style.transform = 'scale(0.96)';
        });
        button.addEventListener('mouseup', () => {
            button.style.transform = '';
        });
    });
</script>
</body>
</html>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/landing/index.blade.php ENDPATH**/ ?>