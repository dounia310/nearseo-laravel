<!-- Sidebar Navigation -->
<aside class="fixed left-0 top-0 h-full flex flex-col p-4 z-40 bg-surface-container-lowest dark:bg-inverse-surface border-r border-outline-variant dark:border-outline w-64 hidden md:flex">
    
    <!-- Logo Section (fixe en haut) -->
    <div class="mb-8">
        <h1 class="font-h3 text-h3 text-primary dark:text-primary-fixed-dim font-bold">NEARSEO</h1>
        <p class="text-xs text-on-surface-variant opacity-70">Expert SEO Local</p>
    </div>
    
    <!-- Navigation Section (scrollable si besoin, mais reste au milieu) -->
    <nav class="flex-1 flex flex-col gap-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('dashboard') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high'); ?>">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Tableau de bord</span>
        </a>
        
        <!-- Content Strategy -->
        <a href="<?php echo e(route('ai.create')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('ai.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high'); ?>">
            <span class="material-symbols-outlined">edit_note</span>
            <span>Stratégie de contenu</span>
        </a>
        
        <!-- Articles -->
        <a href="<?php echo e(route('articles.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('articles.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high'); ?>">
            <span class="material-symbols-outlined">description</span>
            <span>Articles</span>
        </a>
        
        <!-- Communauté -->
        <a href="<?php echo e(route('community')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
            <span class="material-symbols-outlined">groups</span>
            <span>Communauté</span>
        </a>
        
        <!-- Géo -->
        <a href="<?php echo e(route('geo.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('geo.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high'); ?>">
            <span class="material-symbols-outlined">distance</span>
            <span>Géolocalisation</span>
        </a>
        
        <!-- Blog (uniquement si utilisateur connecté) -->
        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('blog.user', auth()->user()->blogSlug)); ?>" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('blog.user*') ? 'bg-secondary-container text-on-secondary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low'); ?>">
            <span class="material-symbols-outlined">feed</span>
            <span>Mon Blog</span>
        </a>
        <?php endif; ?>
        
        <!-- Profil -->
        <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('profile.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high'); ?>">
            <span class="material-symbols-outlined">account_circle</span>
            <span>Profil</span>
        </a>
        
        <!-- Paramètres -->
        <a href="<?php echo e(route('settings.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('settings.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high'); ?>">
            <span class="material-symbols-outlined">settings</span>
            <span>Paramètres</span>
        </a>
    </nav>

    <!-- Footer Section (Aide + Déconnexion) - FIXÉS EN BAS -->
    <div class="border-t border-outline-variant pt-4 mt-4 flex flex-col gap-2 shrink-0">
        <!-- Aide -->
        <a href="<?php echo e(route('help')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
            <span class="material-symbols-outlined">help_outline</span>
            <span>Aide</span>
        </a>
        
        <!-- Déconnexion -->
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
                <span class="material-symbols-outlined">logout</span>
                <span>Déconnexion</span>
            </button>
        </form>
    </div>
</aside><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/components/sidebar.blade.php ENDPATH**/ ?>