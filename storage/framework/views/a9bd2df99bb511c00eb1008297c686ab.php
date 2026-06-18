

<?php $__env->startSection('title', 'Paramètres'); ?>
<?php $__env->startSection('header-title', 'Paramètres'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-container-max-width mx-auto space-y-6">
    <!-- Horizontal Tabs -->
    <div class="border-b border-outline-variant sticky top-0 bg-background z-10 pt-2">
        <nav class="flex gap-8 px-2 overflow-x-auto no-scrollbar">
            <button class="tab-btn pb-3 px-1 font-label text-on-surface-variant hover:text-primary transition-colors relative" data-tab="profile">
                Profil
            </button>
            <button class="tab-btn pb-3 px-1 font-label text-on-surface-variant hover:text-primary transition-colors relative" data-tab="security">
                Sécurité
            </button>
            <button class="tab-btn pb-3 px-1 font-label text-on-surface-variant hover:text-primary transition-colors relative" data-tab="preferences">
                Préférences
            </button>
            <?php if(Auth::user()->role === 'admin'): ?>
            <button class="tab-btn pb-3 px-1 font-label text-on-surface-variant hover:text-primary transition-colors relative" data-tab="users">
                Utilisateurs
            </button>
            <button class="tab-btn pb-3 px-1 font-label text-on-surface-variant hover:text-primary transition-colors relative" data-tab="statistics">
                Statistiques
            </button>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Tab Content: Profil -->
    <div id="tab-profile" class="tab-content">
        <?php echo $__env->make('settings.partials.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Tab Content: Sécurité -->
    <div id="tab-security" class="tab-content hidden">
        <?php echo $__env->make('settings.partials.security', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Tab Content: Préférences -->
    <div id="tab-preferences" class="tab-content hidden">
        <?php echo $__env->make('settings.partials.preferences', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <?php if(Auth::user()->role === 'admin'): ?>
    <!-- Tab Content: Utilisateurs -->
    <div id="tab-users" class="tab-content hidden">
        <?php echo $__env->make('settings.partials.admin-users', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Tab Content: Statistiques -->
    <div id="tab-statistics" class="tab-content hidden">
        <?php echo $__env->make('settings.partials.admin-stats', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Gestion des onglets
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            
            // Mettre à jour l'apparence des onglets
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('text-primary', 'font-bold');
                b.classList.add('text-on-surface-variant');
                const indicator = b.querySelector('.active-tab-indicator');
                if(indicator) indicator.remove();
            });
            
            this.classList.add('text-primary', 'font-bold');
            this.classList.remove('text-on-surface-variant');
            
            // Ajouter l'indicateur visuel
            const indicatorDiv = document.createElement('div');
            indicatorDiv.className = 'active-tab-indicator';
            indicatorDiv.style.position = 'absolute';
            indicatorDiv.style.bottom = '-2px';
            indicatorDiv.style.left = '0';
            indicatorDiv.style.width = '100%';
            indicatorDiv.style.height = '2px';
            indicatorDiv.style.backgroundColor = '#8c4a2f';
            this.appendChild(indicatorDiv);
            
            // Afficher/cacher les contenus
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(`tab-${tabId}`).classList.remove('hidden');
        });
    });
    
    // Activer le premier onglet par défaut
    document.querySelector('.tab-btn')?.click();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/settings.blade.php ENDPATH**/ ?>