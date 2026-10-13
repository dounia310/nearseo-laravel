
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['active' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter flex justify-between items-center h-24">
        
        <!-- Logo agrandi -->
        <div class="flex items-center">
            <img src="<?php echo e(asset('logo.png')); ?>" 
                 alt="NEARSEO Logo" 
                 class="h-16 w-auto md:h-20 object-contain"
                 onerror="this.src='<?php echo e(asset('images/logo.png')); ?>'">
        </div>
        
        <!-- Navigation desktop -->
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors <?php echo e($active === 'features' ? 'text-primary font-bold' : ''); ?>" 
               href="<?php echo e(route('landing')); ?>#features">
                Fonctionnalités
            </a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors <?php echo e($active === 'pricing' ? 'text-primary font-bold' : ''); ?>" 
               href="<?php echo e(route('landing')); ?>#pricing">
                Tarifs
            </a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors <?php echo e($active === 'community' ? 'text-primary font-bold border-b-2 border-primary pb-1' : ''); ?>" 
               href="<?php echo e(route('community')); ?>">
                Communauté
            </a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors flex items-center gap-1 <?php echo e($active === 'help' ? 'text-primary font-bold border-b-2 border-primary pb-1' : ''); ?>" 
               href="<?php echo e(route('help')); ?>">
                Aide
            </a>
            
            <!-- ===== AUTHENTIFICATION ===== -->
            <?php if(auth()->guard()->check()): ?>
                <!-- Utilisateur connecté -->
                <div class="flex items-center gap-3 ml-4">
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                            <?php echo e(auth()->user()->name ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'U'); ?>

                        </div>
                        <span class="font-body text-body hidden lg:inline"><?php echo e(auth()->user()->name ?? 'Utilisateur'); ?></span>
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-on-surface-variant hover:text-error transition-colors text-sm font-label flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            <span class="hidden lg:inline">Déconnexion</span>
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <!-- Utilisateur non connecté -->
                <div class="flex items-center gap-4 ml-4">
                    <a href="<?php echo e(route('login')); ?>" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors">Connexion</a>
                    <a href="<?php echo e(route('register')); ?>" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-label transition-all active:scale-95 whitespace-nowrap">
                        Essai gratuit
                    </a>
                </div>
            <?php endif; ?>
            <!-- ===== FIN AUTHENTIFICATION ===== -->
        </nav>
        
        <!-- Version mobile (hamburger menu) -->
        <div class="md:hidden flex items-center gap-3">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                    <?php echo e(auth()->user()->name ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'U'); ?>

                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">person</span>
                </a>
            <?php endif; ?>
            <button id="mobileMenuBtn" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    
    <!-- Menu mobile (dropdown) -->
    <div id="mobileMenu" class="hidden md:hidden bg-surface border-b border-outline-variant/30">
        <div class="max-w-container-max-width mx-auto px-gutter py-4 flex flex-col gap-4">
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="<?php echo e(route('landing')); ?>#features">Fonctionnalités</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="<?php echo e(route('landing')); ?>#pricing">Tarifs</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="<?php echo e(route('community')); ?>">Communauté</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="<?php echo e(route('help')); ?>">Aide</a>
            
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('dashboard')); ?>" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-on-surface-variant hover:text-error transition-colors text-body flex items-center gap-2">
                        <span class="material-symbols-outlined">logout</span>
                        Déconnexion
                    </button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors">Connexion</a>
                <a href="<?php echo e(route('register')); ?>" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label text-center hover:bg-primary-container transition-all">
                    Essai gratuit
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
    // Toggle mobile menu
    document.addEventListener('DOMContentLoaded', function() {
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });

            // Fermer le menu en cliquant ailleurs
            document.addEventListener('click', function(event) {
                if (!mobileMenu.classList.contains('hidden')) {
                    if (!mobileMenu.contains(event.target) && !mobileBtn.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        }
    });

    // Header scroll effect - Ajouter une ombre quand on scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 20) {
            header.classList.add('shadow-md');
        } else {
            header.classList.remove('shadow-md');
        }
    });
</script><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/components/public-header.blade.php ENDPATH**/ ?>