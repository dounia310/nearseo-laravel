<!-- Top Navigation -->
<header class="bg-surface dark:bg-surface-container border-b border-outline-variant dark:border-outline sticky top-0 z-30">
    <div class="flex justify-between items-center px-gutter w-full h-16 mx-auto">
        <div class="flex items-center gap-4">
            <span class="md:hidden material-symbols-outlined text-primary cursor-pointer" onclick="toggleMobileMenu()">menu</span>
            <h2 class="font-h2 text-h2 text-primary dark:text-primary-fixed-dim font-bold tracking-tight"><?php echo $__env->yieldContent('header-title', 'NEARSEO'); ?></h2>
        </div>
        
        <div class="flex items-center gap-6">
            <div class="hidden sm:flex items-center bg-surface-container-low px-4 py-1.5 rounded-full border border-outline-variant">
                <span class="material-symbols-outlined text-on-surface-variant text-sm mr-2">search</span>
                <input id="globalSearch" class="bg-transparent border-none focus:ring-0 text-body-sm w-48" placeholder="Rechercher..." type="text"/>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('notifications.index')); ?>" class="material-symbols-outlined text-on-surface-variant cursor-pointer p-2 hover:bg-surface-container-high rounded-full transition-colors">notifications</a>
                <span class="material-symbols-outlined text-on-surface-variant cursor-pointer p-2 hover:bg-surface-container-high rounded-full transition-colors">help</span>
                <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-xs">
                    <?php echo e(strtoupper(substr(Auth::user()->name ?? 'U', 0, 2))); ?>

                </div>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileMenu() {
        const sidebar = document.querySelector('aside');
        sidebar.classList.toggle('hidden');
    }
</script><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/components/topbar.blade.php ENDPATH**/ ?>